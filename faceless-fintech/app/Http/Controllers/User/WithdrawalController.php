<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\User_plans;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalStatus;
use App\Traits\Coinpayment;
use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Twilio\Rest\Client;
use Exception;
use Illuminate\Support\Str;


class WithdrawalController extends Controller
{
    use Coinpayment;

    /**
     * Check account status via AJAX
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_account_status(Request $request)
    {
        $user = Auth::user();
        
        if ($user->account_status == 'on-hold') {
            return response()->json([
                'status' => 'on-hold',
                'message' => 'Your account is currently on hold. Please contact our support team for assistance.'
            ]);
        } elseif ($user->account_status == 'suspended') {
            return response()->json([
                'status' => 'suspended',
                'message' => 'Your account has been suspended. Please contact our support team for further information.'
            ]);
        } else {
            return response()->json(['status' => 'active']);
        }
    }

    /**
     * Redirect to withdrawal funds page
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function withdrawamount(Request $request)
    {
        return redirect()->route('withdrawfunds');
    }

    /**
     * Process loan request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loan(Request $request)
    {
        return redirect()->route('dashboard')
            ->with('success', 'Action Successful! Please wait while we process your loan request.');
    }

    /**
     * Return withdrawals route
     * 
     * @return \Illuminate\View\View
     */
    public function withdrawfunds()
    {
        $paymethod = session('paymentmethod');
        
        // Validate payment method exists
        $checkmethod = Wdmethod::where('name', $paymethod)->first();
        if (!$checkmethod) {
            return redirect()->route('dashboard')
                ->with('message', 'Invalid payment method selected. Please try again.');
        }

        $default = ($checkmethod->defaultpay == "yes");
        $methodtype = ($checkmethod->methodtype == "crypto") ? 'crypto' : 'currency';

        return view('user.withdraw', [
            'title' => 'Complete Withdrawal Request',
            'payment_mode' => $paymethod,
            'default' => $default,
            'methodtype' => $methodtype,
        ]);
    }

    /**
     * Generate and send OTP for withdrawal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getotp()
    {
        // Check if user's transfer action is already in progress
        if (Auth::user()->transferaction == 1) {
            return back();
        }

        $code = $this->RandomnumbrGenerator(6);
        $user = Auth::user();
        
        // Update user with withdrawal OTP
        User::where('id', $user->id)->update([
            'withdrawotp' => $code,
        ]);
        
        $settings = $this->getSettings();

        // Prepare email notification
        $message = "You recently initiated a transfer from your {$settings->site_name} {$user->accounttype} via our online banking channel.\n";
        $message .= "If this was legitimate activity from you and you were expecting this email, consider using the code below to complete your transaction:\n";
        $message .= "\n{$code}\n\n";
        $message .= "If you do not use {$settings->site_name} or did not attempt to carry out a transaction via your {$settings->site_name} internet banking channel, please ignore this email or contact support if you have questions.";
        
        $subject = "Confirm transaction";
        
        // Send email notification
        try {
            Mail::bcc($user->email)->send(new NewNotification($message, $subject, $user->name));
            return redirect()->route('otpview');
        } catch (Exception $e) {
            Log::error('Failed to send OTP email: ' . $e->getMessage());
            return back()->with('message', 'Failed to send OTP. Please try again or contact support.');
        }
    }

    /**
     * Show OTP verification view
     * 
     * @return \Illuminate\View\View
     */
    public function otpview()
    {
        return view('user.otp')->with('success', 'Action Successful! OTP has been sent to your email');
    }

    /**
     * Complete withdrawal process
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completewithdrawal(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'method' => 'required|string',
            'details' => 'nullable|string',
            'otpcode' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('message', 'Invalid withdrawal details. Please check your input and try again.')
                ->withErrors($validator);
        }

        $user = Auth::user();
        $settings = $this->getSettings();

        // Verify OTP if required
        if ($user->sendotpemail == "Yes") {
            if ($request->otpcode != $user->withdrawotp) {
                return redirect()->back()->with('message', 'OTP is incorrect, please recheck the code');
            }
        }

        // Check KYC verification if required
        if ($settings->enable_kyc == "yes") {
            if ($user->account_verify != "Verified") {
                return redirect()->back()->with('message', 'Your account must be verified before you can make withdrawals.');
            }
        }

        // Get withdrawal method and calculate charges
        $method = Wdmethod::where('name', $request->method)->first();
        if (!$method) {
            return redirect()->back()->with('message', 'Invalid withdrawal method selected.');
        }

        // Calculate charges
        $charges = ($method->charges_type == 'percentage') 
            ? $request->amount * $method->charges_amount / 100 
            : $method->charges_amount;

        $to_withdraw = $request->amount + $charges;

        // Check if user has sufficient balance
        if ($user->account_bal < $to_withdraw) {
            return redirect()->back()
                ->with('message', 'Sorry, your account balance is insufficient for this request.');
        }

        // Check minimum withdrawal amount
        if ($request->amount < $method->minimum) {
            $currency = $user->s_curr ?? $settings->currency;
            return redirect()->back()
                ->with("message", "Sorry, the minimum amount you can withdraw is {$currency}{$method->minimum}, please try another payment method.");
        }

        // Check user's custom transfer limits
        if ($request->amount < $user->min_transfer_amount) {
            $currency = $user->s_curr ?? $settings->currency;
            return redirect()->back()
                ->with('message', "Transfer amount cannot be less than your minimum transfer limit of {$currency}" . number_format((float)$user->min_transfer_amount, 2) . '.');
        }

        if ($request->amount > $user->max_transfer_amount) {
            $currency = $user->s_curr ?? $settings->currency;
            return redirect()->back()
                ->with('message', "Transfer amount cannot exceed your maximum transfer limit of {$currency}" . number_format((float)$user->max_transfer_amount, 2) . '.');
        }

        // Get user's active investment plan
        $plan = User_plans::where('user', $user->id)
            ->where('active', 'yes')
            ->orderBy('activated_at', 'asc')
            ->first();

        // Check wallet address for crypto withdrawals
        $coin = null;
        $wallet = null;

        if ($request->method == 'Bitcoin') {
            if (empty($user->btc_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please setup your Bitcoin Wallet Address');
            }
            $coin = "BTC";
            $wallet = $user->btc_address;
        } elseif ($request->method == 'Ethereum') {
            if (empty($user->eth_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please setup your Ethereum Wallet Address');
            }
            $coin = "ETH";
            $wallet = $user->eth_address;
        } elseif ($request->method == 'Litecoin') {
            if (empty($user->ltc_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please setup your Litecoin Wallet Address');
            }
            $coin = "LTC";
            $wallet = $user->ltc_address;
        } elseif ($request->method == 'USDT') {
            if (empty($user->usdt_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please setup your USDT Wallet Address');
            }
            $coin = "USDT.TRC20";
            $wallet = $user->usdt_address;
        } elseif ($request->method == 'Bank Transfer') {
            if (empty($user->account_name) || empty($user->bank_name) || empty($user->account_number)) {
                return redirect()->route('profile')
                    ->with('message', 'Please setup your Bank Account Details');
            }
        }

        $amount = $request->amount;
        $userId = $user->id;

        // Process automatic withdrawal for cryptocurrencies if enabled
        if ($settings->withdrawal_option == "auto" && in_array($request->method, ['Bitcoin', 'Litecoin', 'Ethereum', 'USDT'])) {
            return $this->cpwithdraw($amount, $coin, $wallet, $userId, $to_withdraw);
        }

        // Wrap financial transaction in a database lock to prevent race conditions
        try {
            DB::beginTransaction();

            // Lock the user row for update
            $lockedUser = User::where('id', $userId)->lockForUpdate()->first();

            // Check if user has sufficient balance (re-check after acquiring lock)
            if ($lockedUser->account_bal < $to_withdraw) {
                DB::rollBack();
                return redirect()->back()
                    ->with('message', 'Sorry, your account balance is insufficient for this request.');
            }

            // Debit user's account
            $lockedUser->update([
                'account_bal' => $lockedUser->account_bal - $to_withdraw,
                'withdrawotp' => null,
            ]);

            // Create withdrawal record
            $withdrawal = new Withdrawal();
            $withdrawal->amount = $amount;
            $withdrawal->to_deduct = $to_withdraw;
            $withdrawal->payment_mode = $request->method;
            $withdrawal->status = 'Pending';
            $withdrawal->paydetails = $request->details;
            $withdrawal->user = $userId;
            $withdrawal->save();

            DB::commit();

            // Create notification
            $currency = $lockedUser->s_curr ?? $settings->currency;
            NotificationHelper::create(
                $lockedUser,
                "Your withdrawal request for {$currency}{$amount} via {$request->method} has been submitted and is pending approval.",
                'Withdrawal Request Submitted',
                'info',
                'alert-circle',
                route('withdrawalsdeposits')
            );

            // Send email notifications
            Mail::to($settings->contact_email)->send(new WithdrawalStatus($withdrawal, $lockedUser, 'Withdrawal Request', true));
            Mail::to($lockedUser->email)->send(new WithdrawalStatus($withdrawal, $lockedUser, 'Successful Withdrawal Request'));

            return redirect()->route('withdrawalsdeposits')
                ->with('success', 'Action Successful! Please wait while we process your request.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal error: ' . $e->getMessage());
            return redirect()->back()
                ->with('message', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Process local transfer
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function localtransfer(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'bankname' => 'required|string',
            'accountname' => 'required|string',
            'accountnumber' => 'required|string',
            'Accounttype' => 'required|string',
            'routing_number' => 'nullable|string|max:9',
            'swift_code' => 'nullable|string|max:11',
            'Description' => 'nullable|string',
            'pin' => 'required|string',
            'balance_type' => 'required|string|in:fiat'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('message', 'Invalid transfer details. Please check your input and try again.')
                ->withErrors($validator);
        }

        $user = Auth::user();
        $settings = $this->getSettings();

        // Check if account is active
        if ($user->account_status != 'active') {
            return redirect()->back()
                ->with("message", "Sorry, your account is dormant. Contact support on {$settings->contact_email} for more details.");
        }

        // Validate transaction PIN
        if ($user->pin != $request->pin) {
            return redirect()->back()
                ->with("message", "Sorry, incorrect transaction pin");
        }

        // Check fiat account balance (local transfers only use fiat balance)
        if ($user->account_bal < $request->amount) {
            return redirect()->back()
                ->with('message', 'Sorry, your account balance is insufficient for this request.');
        }

        // Check user's custom transfer limits
        if ($request->amount < $user->min_transfer_amount) {
            $currency = $user->s_curr ?? $settings->currency;
            return redirect()->back()
                ->with('message', "Transfer amount cannot be less than your minimum transfer limit of {$currency}" . number_format((float)$user->min_transfer_amount, 2) . '.');
        }

        if ($request->amount > $user->max_transfer_amount) {
            $currency = $user->s_curr ?? $settings->currency;
            return redirect()->back()
                ->with('message', "Transfer amount cannot exceed your maximum transfer limit of {$currency}" . number_format((float)$user->max_transfer_amount, 2) . '.');
        }
        
        // Check user's custom transfer limits
        if ($request->amount < $user->min_transfer_amount) {
            $currency = $user->s_curr ?? $settings->currency;
            return redirect()->back()
                ->with('message', "Transfer amount cannot be less than your minimum transfer limit of {$currency}" . number_format((float)$user->min_transfer_amount, 2) . '.');
        }

        if ($request->amount > $user->max_transfer_amount) {
            $currency = $user->s_curr ?? $settings->currency;
            return redirect()->back()
                ->with('message', "Transfer amount cannot exceed your maximum transfer limit of {$currency}" . number_format((float)$user->max_transfer_amount, 2) . '.');
        }
        
         if (Auth::user()->dailyTotal ==1 ) {


            return redirect()->back()->with('message', 'Daily transaction limit exceeded.');
        }

        if (Auth::user()->weeklyTotal  ==1) {


            return redirect()->back()->with(['message', 'Weekly transaction limit exceeded.']);
        }

        if (Auth::user()->monthlyTotal ==1) {

            return redirect()->back()->with(['message' ,'Monthly transaction limit exceeded.']);
        }


        // Generate transaction ID
        $subtxn = substr(strtoupper($settings->site_name), 0, 4);
        $codetxn1 = $this->RandomStringGenerator(8);
        $codetxn2 = substr(strtoupper(Str::uuid()->toString()), 0, 4);

        // Prepare transaction data
        $data = [
            'bankname' => $request->bankname,
            'amount' => $request->amount,
            'accountname' => $request->accountname,
            'accountnumber' => $request->accountnumber,
            'Accounttype' => $request->Accounttype,
            'routing_number' => $request->routing_number,
            'swiftcode' => $request->swift_code,
            'Description' => $request->Description,
            'user' => $user->id,
            'payment_mode' => "Domestic Transfer",
            'date' => Carbon::now(),
            'txn_id' => "{$subtxn}/{$codetxn1}-{$codetxn2}",
            'balance_type' => 'fiat'  // Local transfers always use fiat balance
        ];

        Session::put('data', $data);

        // Make sure transferaction is 0 before redirecting to verification pages
        if ($user->transferaction == '1') {
            User::where('id', $user->id)->update([
                'transferaction' => 0,
            ]);
        }

        // Process verification steps based on settings
        if ($settings->code1status == 1) {
            return redirect()->route('code1verification');
        }

        if ($settings->code2status == 1) {
            return redirect()->route('verificationcode2');
        }

        if ($settings->code3status == 1) {
            return redirect()->route('verification3code');
        }

        if ($settings->code4status == 1) {
            return redirect()->route('code4verification');
        }

        if ($settings->code5status == 1) {
            return redirect()->route('code5verification');
        }

        if ($settings->otp == 1) {
            return redirect()->route('getotp');
        }

        sleep(3);
        return redirect()->route('previewtransfer', 'data');
    }

    /**
     * Process international transfer
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function internationaltransfer(Request $request)
    {
        // Basic validation for all payment methods
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|gt:0',
            'withdrawMethod' => 'required|string',
            'pin' => 'required|string',
            'Description' => 'nullable|string',
            'balance_type' => 'required|string|in:fiat,btc'
        ]);
        
        // Additional validation based on method and balance type combination
        $withdrawMethod = $request->withdrawMethod;
        $balance_type = $request->balance_type;
        
        // Validate minimum amounts based on balance type
        if ($balance_type === 'fiat' && $request->amount < 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('amount', 'Minimum fiat transfer amount is 1.');
            });
        }
        
        if ($balance_type === 'btc' && $request->amount < 0.00000001) {
            $validator->after(function ($validator) {
                $validator->errors()->add('amount', 'Minimum Bitcoin transfer amount is 0.00000001 BTC.');
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->with('message', 'Invalid transfer details. Please check your input and try again.')
                ->withErrors($validator);
        }

        $user = Auth::user();
        $settings = $this->getSettings();

        // Check if account is active
        if ($user->account_status != 'active') {
            return redirect()->back()
                ->with("message", "Sorry, your account is dormant. Contact support on {$settings->contact_email} for more details.");
        }

        // Validate transaction PIN
        if ($user->pin != $request->pin) {
            return redirect()->back()
                ->with("message", "Sorry, incorrect transaction pin");
        }

        // Validate balance type based on method
        $balance_type = $request->balance_type;
        $withdrawMethod = $request->withdrawMethod;
        
        // Cryptocurrency method must use Bitcoin balance
        if ($withdrawMethod === 'Cryptocurrency' && $balance_type !== 'btc') {
            return redirect()->back()
                ->with('message', 'Cryptocurrency transfers must use Bitcoin balance.');
        }
        
        // All other methods must use fiat balance
        if ($withdrawMethod !== 'Cryptocurrency' && $balance_type !== 'fiat') {
            return redirect()->back()
                ->with('message', 'This transfer method only supports fiat balance.');
        }
        
        // Check account balance based on selected balance type
        if ($balance_type === 'fiat') {
            if ($user->account_bal < $request->amount) {
                return redirect()->back()
                    ->with('message', 'Sorry, your account balance is insufficient for this request.');
            }
        } else { // btc balance
            if (($user->btc_balance ?? 0) < $request->amount) {
                return redirect()->back()
                    ->with('message', 'Sorry, your Bitcoin balance is insufficient for this request.');
            }
        }
        
        
         if (Auth::user()->dailyTotal ==1 ) {


        return redirect()->back()->with('message', 'Daily transaction limit exceeded.');
    }

    if (Auth::user()->weeklyTotal  ==1) {


        return redirect()->back()->with(['message', 'Weekly transaction limit exceeded.']);
    }

    if (Auth::user()->monthlyTotal ==1) {

        return redirect()->back()->with(['message' ,'Monthly transaction limit exceeded.']);
    }

        // Update transfer action flag
        if ($user->transferaction == '1') {
            User::where('id', $user->id)->update([
                'transferaction' => 0,
            ]);
        }

        // Generate transaction ID
        $subtxn = substr(strtoupper($settings->site_name), 0, 4);
        $codetxn1 = $this->RandomStringGenerator(8);
        $codetxn2 = substr(strtoupper(Carbon::now()), 0, 4);

        // Create base data array that will be common for all methods
        $data = [
            'amount' => $request->amount,
            'user' => $user->id,
            'date' => Carbon::now(),
            'txn_id' => "{$subtxn}/{$codetxn1}-{$codetxn2}",
            'Description' => $request->Description,
            'balance_type' => $request->balance_type
        ];

        // Add method-specific data and validation based on the withdrawal method
        switch ($request->withdrawMethod) {
    case 'Wire Transfer':
        $wireValidator = Validator::make($request->all(), [
            'accountname' => 'required|string',
            'accountnumber' => 'required|string',
            'bankname' => 'required|string',
            'bankaddress' => 'required|string',
            'country' => 'required|string',
            'Accounttype' => 'required|string',
            'iban' => 'nullable|string|max:34',
            'swiftcode' => 'nullable|string|max:11',
        ]);

        if ($wireValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required wire transfer details.')
                ->withErrors($wireValidator);
        }

        $data['payment_mode'] = 'International Wire Transfer';
        $data['accountname'] = $request->accountname;
        $data['accountnumber'] = $request->accountnumber;
        $data['bankname'] = $request->bankname;
        $data['bankaddress'] = $request->bankaddress;
        $data['Accounttype'] = $request->Accounttype;
        $data['country'] = $request->country;
        $data['iban'] = $request->iban;
        $data['swiftcode'] = $request->swiftcode;
        break;

    case 'Cryptocurrency':
        $cryptoValidator = Validator::make($request->all(), [
            'cryptoCurrency' => 'required|string',
            'cryptoNetwork' => 'required|string',
            'walletAddress' => 'required|string',
        ]);

        if ($cryptoValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required cryptocurrency details.')
                ->withErrors($cryptoValidator);
        }

        $data['payment_mode'] = 'Cryptocurrency';
        $data['crypto_currency'] = $request->cryptoCurrency;
        $data['crypto_network'] = $request->cryptoNetwork;
        $data['wallet_address'] = $request->walletAddress;
        break;

    case 'PayPal':
        $paypalValidator = Validator::make($request->all(), [
            'paypalEmail' => 'required|email',
        ]);

        if ($paypalValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please provide a valid PayPal email address.')
                ->withErrors($paypalValidator);
        }

        $data['payment_mode'] = 'PayPal';
        $data['paypal_email'] = $request->paypalEmail;
        break;

    case 'Wise Transfer':
        $wiseValidator = Validator::make($request->all(), [
            'wiseFullName' => 'required|string',
            'wiseEmail' => 'required|email',
            'wiseCountry' => 'required|string',
        ]);

        if ($wiseValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required Wise transfer details.')
                ->withErrors($wiseValidator);
        }

        $data['payment_mode'] = 'Wise Transfer';
        $data['wise_fullname'] = $request->wiseFullName;
        $data['wise_email'] = $request->wiseEmail;
        $data['wise_country'] = $request->wiseCountry;
        break;

    case 'Skrill':
        $skrillValidator = Validator::make($request->all(), [
            'skrillEmail' => 'required|email',
            'skrillFullName' => 'required|string',
        ]);

        if ($skrillValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required Skrill details.')
                ->withErrors($skrillValidator);
        }

        $data['payment_mode'] = 'Skrill';
        $data['skrill_email'] = $request->skrillEmail;
        $data['skrill_fullname'] = $request->skrillFullName;
        break;

    case 'Venmo':
        $venmoValidator = Validator::make($request->all(), [
            'venmoUsername' => 'required|string',
            'venmoPhone' => 'required|string',
        ]);

        if ($venmoValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required Venmo details.')
                ->withErrors($venmoValidator);
        }

        $data['payment_mode'] = 'Venmo';
        $data['venmo_username'] = $request->venmoUsername;
        $data['venmo_phone'] = $request->venmoPhone;
        break;

    case 'Zelle':
        $zelleValidator = Validator::make($request->all(), [
            'zelleEmail' => 'nullable|email',
            'zellePhone' => 'nullable|string',
            'zelleName' => 'required|string',
        ]);

        if ($zelleValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required Zelle details. Either email or phone must be provided.')
                ->withErrors($zelleValidator);
        }

        if (empty($request->zelleEmail) && empty($request->zellePhone)) {
            return redirect()->back()
                ->with('message', 'Please provide either an email or phone number for Zelle transfers.');
        }

        $data['payment_mode'] = 'Zelle';
        $data['zelle_email'] = $request->zelleEmail;
        $data['zelle_phone'] = $request->zellePhone;
        $data['zelle_name'] = $request->zelleName;
        break;

    case 'Cash App':
        $cashAppValidator = Validator::make($request->all(), [
            'cashAppTag' => 'required|string',
            'cashAppFullName' => 'required|string',
        ]);

        if ($cashAppValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required Cash App details.')
                ->withErrors($cashAppValidator);
        }

        $data['payment_mode'] = 'Cash App';
        $data['cash_app_tag'] = $request->cashAppTag;
        $data['cash_app_fullname'] = $request->cashAppFullName;
        break;

    case 'Revolut':
        $revolutValidator = Validator::make($request->all(), [
            'revolutFullName' => 'required|string',
            'revolutEmail' => 'required|email',
            'revolutPhone' => 'required|string',
        ]);

        if ($revolutValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required Revolut details.')
                ->withErrors($revolutValidator);
        }

        $data['payment_mode'] = 'Revolut';
        $data['revolut_fullname'] = $request->revolutFullName;
        $data['revolut_email'] = $request->revolutEmail;
        $data['revolut_phone'] = $request->revolutPhone;
        break;

    case 'Alipay':
        $alipayValidator = Validator::make($request->all(), [
            'alipayId' => 'required|string',
            'alipayFullName' => 'required|string',
        ]);

        if ($alipayValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required Alipay details.')
                ->withErrors($alipayValidator);
        }

        $data['payment_mode'] = 'Alipay';
        $data['alipay_id'] = $request->alipayId;
        $data['alipay_fullname'] = $request->alipayFullName;
        break;

    case 'WeChat Pay':
        $wechatValidator = Validator::make($request->all(), [
            'wechatId' => 'required|string',
            'wechatName' => 'required|string',
        ]);

        if ($wechatValidator->fails()) {
            return redirect()->back()
                ->with('message', 'Please fill in all required WeChat Pay details.')
                ->withErrors($wechatValidator);
        }

        $data['payment_mode'] = 'WeChat Pay';
        $data['wechat_id'] = $request->wechatId;
        $data['wechat_name'] = $request->wechatName;
        break;

    default:
        return redirect()->back()
            ->with('message', 'Please select a valid withdrawal method.');
}

        // Store data in session
        Session::put('data', $data);

        // Process verification steps based on settings
        if ($settings->code1status == 1) {
            return redirect()->route('code1verification');
        }

        if ($settings->code2status == 1) {
            return redirect()->route('verificationcode2');
        }

        if ($settings->code3status == 1) {
            return redirect()->route('verification3code');
        }

        if ($settings->code4status == 1) {
            return redirect()->route('code4verification');
        }

        if ($settings->code5status == 1) {
            return redirect()->route('code5verification');
        }

        if ($settings->otp == 1) {
            return redirect()->route('getotp');
        }

        return redirect()->route('previewtransfer');
    }

    /**
     * Verify confirmation codes
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function codecomfirm(Request $request)
    {
        $user = Auth::user();
        $settings = $this->getSettings();
        $data = Session::get('data');

        // Code1 verification
        if ($request->has('code1')) {
            $validator = Validator::make($request->all(), [
                'code1' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('message', 'Please enter the verification code.');
            }

            if ($user->code1 != $request->code1) {
                return redirect()->back()
                    ->with("message", "Sorry, Invalid {$settings->code1} code! Contact support on {$settings->contact_email} for the appropriate {$settings->code1} for this transaction.");
            }

            if ($settings->code2status == 1) {
                sleep(3);
                return redirect()->route('verificationcode2');
            }

            if ($settings->code3status == 1) {
                sleep(3);
                return redirect()->route('verification3code');
            }

            if ($settings->code4status == 1) {
                sleep(3);
                return redirect()->route('code4verification');
            }

            if ($settings->code5status == 1) {
                sleep(3);
                return redirect()->route('code5verification');
            }

            if ($settings->otp == 1) {
                sleep(3);
                return redirect()->route('getotp');
            }
        }

        // Code2 verification
        if ($request->has('code2')) {
            $validator = Validator::make($request->all(), [
                'code2' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('message', 'Please enter the verification code.');
            }

            if ($user->code2 != $request->code2) {
                return redirect()->back()
                    ->with("message", "Sorry, Invalid {$settings->code2} code! Contact support on {$settings->contact_email} for the appropriate {$settings->code2} for this transaction.");
            }

            if ($settings->code3status == 1) {
                sleep(3);
                return redirect()->route('verification3code');
            }

            if ($settings->code4status == 1) {
                sleep(3);
                return redirect()->route('code4verification');
            }

            if ($settings->code5status == 1) {
                sleep(3);
                return redirect()->route('code5verification');
            }

            if ($settings->otp == 1) {
                sleep(3);
                return redirect()->route('getotp');
            }
        }

        // Code3 verification
        if ($request->has('code3')) {
            $validator = Validator::make($request->all(), [
                'code3' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('message', 'Please enter the verification code.');
            }

            if ($user->code3 != $request->code3) {
                return redirect()->back()
                    ->with("message", "Sorry, Invalid {$settings->code3} code! Contact support on {$settings->contact_email} for the appropriate {$settings->code3} for this transaction.");
            }

            if ($settings->code4status == 1) {
                sleep(3);
                return redirect()->route('code4verification');
            }

            if ($settings->code5status == 1) {
                sleep(3);
                return redirect()->route('code5verification');
            }

            if ($settings->otp == 1) {
                sleep(3);
                return redirect()->route('getotp');
            }
        }

        // Code4 verification
        if ($request->has('code4')) {
            $validator = Validator::make($request->all(), [
                'code4' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('message', 'Please enter the verification code.');
            }

            if ($user->code4 != $request->code4) {
                return redirect()->back()
                    ->with("message", "Sorry, Invalid {$settings->code4} code! Contact support on {$settings->contact_email} for the appropriate {$settings->code4} for this transaction.");
            }

            if ($settings->code5status == 1) {
                sleep(3);
                return redirect()->route('code5verification');
            }

            if ($settings->otp == 1) {
                sleep(3);
                return redirect()->route('getotp');
            }
        }

        // Code5 verification
        if ($request->has('code5')) {
            $validator = Validator::make($request->all(), [
                'code5' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('message', 'Please enter the verification code.');
            }

            if ($user->code5 != $request->code5) {
                return redirect()->back()
                    ->with("message", "Sorry, Invalid {$settings->code5} code! Contact support on {$settings->contact_email} for the appropriate {$settings->code5} for this transaction.");
            }

            if ($settings->otp == 1) {
                sleep(3);
                return redirect()->route('getotp');
            }
        }

        // OTP verification
        if ($request->has('otp')) {
            $validator = Validator::make($request->all(), [
                'otp' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('message', 'Please enter the OTP code.');
            }

            if ($user->withdrawotp != $request->otp) {
                return redirect()->back()
                    ->with("message", "Sorry, Invalid OTP code!");
            }
        }

        sleep(3);
        return redirect()->route('previewtransfer');
    }

    /**
     * Preview and process transfer
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function previewtransfer(Request $request)
    {
        $settings = $this->getSettings();
        $user = Auth::user();

        // If an ID is provided in the request, we're viewing an existing transaction
        if ($request->has('id')) {
            $dp = Withdrawal::where('id', $request->id)
                ->where('user', $user->id)
                ->first();

            if (!$dp) {
               $dp = Deposit::where('id', $request->id)
                ->where('user', $user->id)
                ->first();
            }

            $code = $dp->txn_id;
            return view('user.preview', compact('settings', 'dp', 'code'));
        }

        // Process a new transaction from session
        $data = Session::get('data');
        if (!$data) {
            return redirect()->route('dashboard')
                ->with('message', 'No transaction data found. Please start again.');
        }

        // Calculate amount to withdraw including fees
        $amount = $data['amount'];
        $to_withdraw = $amount;
        
        // Check balance type and handle accordingly
        $balance_type = $data['balance_type'] ?? 'fiat';
        
        // For local transfers (Domestic Transfer), always use fiat balance
        if ($data['payment_mode'] === 'Domestic Transfer') {
            $balance_type = 'fiat';
        }
        
        if ($balance_type === 'fiat') {
            // Final balance check for fiat
            if ($user->account_bal < $to_withdraw) {
                return redirect()->back()
                    ->with("message", "Sorry, your account balance is insufficient for this transaction.");
            }
            
            $balance = $user->account_bal - $to_withdraw;
            
            try {
                // Debit user's fiat balance
                User::where('id', $user->id)->update([
                    'account_bal' => $balance,
                    'withdrawotp' => null,
                ]);
            } catch (Exception $e) {
                Log::error('Error updating fiat balance: ' . $e->getMessage());
                return redirect()->route('dashboard')
                    ->with('message', 'An error occurred while processing your transfer. Please try again later.');
            }
        } else { // BTC balance (only for international transfers)
            // Final balance check for BTC
            if (($user->btc_balance ?? 0) < $to_withdraw) {
                return redirect()->back()
                    ->with("message", "Sorry, your Bitcoin balance is insufficient for this transaction.");
            }
            
            $balance = ($user->btc_balance ?? 0) - $to_withdraw;
            
            try {
                // Debit user's BTC balance
                User::where('id', $user->id)->update([
                    'btc_balance' => $balance,
                    'withdrawotp' => null,
                ]);
            } catch (Exception $e) {
                Log::error('Error updating BTC balance: ' . $e->getMessage());
                return redirect()->route('dashboard')
                    ->with('message', 'An error occurred while processing your transfer. Please try again later.');
            }
        }

        try {
            // Get current BTC rate using the API function
            $user = Auth::user();
            $btc_rate = $this->getBitcoinPrice($user->curr);
            
            // Create withdrawal record
            $dp = new Withdrawal();
            
            // If using BTC balance, convert the amount to user currency equivalent for display
            if ($balance_type === 'btc') {
                // Store original BTC amount in a separate field
                $dp->btc_amount = $data['amount'];
                // Convert BTC to user currency equivalent for the main amount field
                $dp->amount = $data['amount'] * $btc_rate;
                // Also store the BTC rate used for the conversion
                $dp->btc_rate_at_transfer = $btc_rate;
            } else {
                $dp->amount = $data['amount'];
            }
            
            $dp->to_deduct = $to_withdraw;
            $dp->payment_mode = $data['payment_mode'];
            $dp->status = 'Pending';
            $dp->type = 'Debit';
            $dp->date = Carbon::now();
            $dp->txn_id = $data['txn_id'];
            $dp->user = $user->id;
            $dp->bal = $balance;
            $dp->balance_type = $balance_type; // Store which balance type was used
            $dp->Description = isset($data['Description']) ? $data['Description'] : '';

            // Add method-specific details to the withdrawal record
            switch ($data['payment_mode']) {
    case 'Domestic Transfer':
        $dp->accountname = $data['accountname'];
        $dp->accountnumber = $data['accountnumber'];
        $dp->bankname = $data['bankname'];
        $dp->Accounttype = $data['Accounttype'];
        $dp->routing_number = $data['routing_number'] ?? null;
        $dp->swiftcode = $data['swiftcode'] ?? null;
        break;

    case 'International Wire Transfer':
        $dp->accountname = $data['accountname'];
        $dp->accountnumber = $data['accountnumber'];
        $dp->bankname = $data['bankname'];
        $dp->Accounttype = $data['Accounttype'];
        $dp->bankaddress = $data['bankaddress'];
        $dp->country = $data['country'];
        $dp->iban = $data['iban'] ?? null;
        $dp->swiftcode = $data['swiftcode'] ?? null;
        break;

    case 'Cryptocurrency':
        $dp->crypto_currency = $data['crypto_currency'];
        $dp->crypto_network = $data['crypto_network'];
        $dp->wallet_address = $data['wallet_address'];
        break;

    case 'PayPal':
        $dp->paypal_email = $data['paypal_email'];
        break;

    case 'Wise Transfer':
        $dp->wise_fullname = $data['wise_fullname'];
        $dp->wise_email = $data['wise_email'];
        $dp->wise_country = $data['wise_country'];
        break;
        
    case 'Skrill':
        $dp->skrill_email = $data['skrill_email'];
        $dp->skrill_fullname = $data['skrill_fullname'];
        break;
        
    case 'Venmo':
        $dp->venmo_username = $data['venmo_username'];
        $dp->venmo_phone = $data['venmo_phone'];
        break;
        
    case 'Zelle':
        $dp->zelle_email = $data['zelle_email'];
        $dp->zelle_phone = $data['zelle_phone'];
        $dp->zelle_name = $data['zelle_name'];
        break;
        
    case 'Cash App':
        $dp->cash_app_tag = $data['cash_app_tag'];
        $dp->cash_app_fullname = $data['cash_app_fullname'];
        break;
        
    case 'Revolut':
        $dp->revolut_fullname = $data['revolut_fullname'];
        $dp->revolut_email = $data['revolut_email'];
        $dp->revolut_phone = $data['revolut_phone'];
        break;
        
    case 'Alipay':
        $dp->alipay_id = $data['alipay_id'];
        $dp->alipay_fullname = $data['alipay_fullname'];
        break;
        
    case 'WeChat Pay':
        $dp->wechat_id = $data['wechat_id'];
        $dp->wechat_name = $data['wechat_name'];
        break;
}

            $dp->save();
            $code = $dp->txn_id;

            // Send email notifications
            Mail::to($settings->contact_email)->send(new WithdrawalStatus($dp, $user, 'Transfer Request', true));
            Mail::to($user->email)->send(new WithdrawalStatus($dp, $user, 'Successful Transfer Request'));

            // Send SMS notification if enabled
            $date = Carbon::parse($dp->created_at)->toDayDateTimeString();
            if ($settings->sms == '1') {
                $this->sendTransferSMS($user, $dp, $settings, $date);
            }

            // Turn on transfer action
            User::where('id', $user->id)->update([
                'transferaction' => 1,
            ]);

            sleep(2);
            // Redirect to transfer success page instead of preview
            return redirect()->route('transfer.success', ['id' => $dp->id]);
        } catch (Exception $e) {
            Log::error('Error in previewtransfer: ' . $e->getMessage());
            return redirect()->route('dashboard')
                ->with('message', 'An error occurred while processing your transfer. Please try again later.');
        }
    }

    /**
     * Show transfer success page
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function transferSuccess(Request $request)
    {
        $user = Auth::user();
        $settings = $this->getSettings();
        
        // Get the withdrawal record
        if (!$request->has('id')) {
            return redirect()->route('dashboard')
                ->with('message', 'Transfer not found.');
        }
        
        $dp = Withdrawal::where('id', $request->id)
            ->where('user', $user->id)
            ->first();
            
        if (!$dp) {
            return redirect()->route('dashboard')
                ->with('message', 'Transfer not found or access denied.');
        }
        
        // Get currency
        $currency = $user->s_curr ?? $settings->currency;
        
        // Determine recipient name based on payment method
        $recipientName = 'Recipient';
        switch ($dp->payment_mode) {
            case 'Domestic Transfer':
            case 'International Wire Transfer':
                $recipientName = $dp->accountname ?? 'Bank Account';
                break;
            case 'PayPal':
                $recipientName = $dp->paypal_email ?? 'PayPal Account';
                break;
            case 'Wise Transfer':
                $recipientName = $dp->wise_fullname ?? 'Wise Account';
                break;
            case 'Skrill':
                $recipientName = $dp->skrill_fullname ?? 'Skrill Account';
                break;
            case 'Venmo':
                $recipientName = $dp->venmo_username ?? 'Venmo Account';
                break;
            case 'Zelle':
                $recipientName = $dp->zelle_name ?? 'Zelle Account';
                break;
            case 'Cash App':
                $recipientName = $dp->cash_app_fullname ?? 'Cash App Account';
                break;
            case 'Revolut':
                $recipientName = $dp->revolut_fullname ?? 'Revolut Account';
                break;
            case 'Alipay':
                $recipientName = $dp->alipay_fullname ?? 'Alipay Account';
                break;
            case 'WeChat Pay':
                $recipientName = $dp->wechat_name ?? 'WeChat Pay Account';
                break;
            case 'Cryptocurrency':
                $recipientName = $dp->crypto_currency . ' Wallet';
                break;
            default:
                $recipientName = $dp->payment_mode . ' Account';
        }
        
        return view('user.transfer-success', compact('dp', 'currency', 'recipientName', 'settings', 'user'));
    }

    /**
     * Send SMS notification for transfer
     * 
     * @param User $user
     * @param Withdrawal $dp
     * @param Settings $settings
     * @param string $date
     * @return void
     */
    private function sendTransferSMS($user, $dp, $settings, $date)
    {
        $receiverNumber = $user->phone;
        if (empty($receiverNumber)) {
            return;
        }

        // Customize message based on payment method
        $paymentDetails = "";
        
        switch ($dp->payment_mode) {
            case 'International Wire Transfer':
                $paymentDetails = "Account Number: {$dp->accountnumber}\nAccount Name: {$dp->accountname}\nBank Name: {$dp->bankname}";
                break;
            case 'Cryptocurrency':
                $paymentDetails = "Currency: {$dp->crypto_currency}\nNetwork: {$dp->crypto_network}\nWallet: {$dp->wallet_address}";
                break;
            case 'PayPal':
                $paymentDetails = "PayPal Email: {$dp->paypal_email}";
                break;
            case 'Wise Transfer':
                $paymentDetails = "Recipient: {$dp->wise_fullname}\nEmail: {$dp->wise_email}";
                break;
            // Add cases for other payment methods
            default:
                $paymentDetails = "Payment Method: {$dp->payment_mode}";
        }

        $currency = $user->s_curr ?? $settings->currency;
        
        $message = "Your transfer request of {$currency}{$dp->amount} via {$dp->payment_mode} has been confirmed and is being processed." .
            "\nDetails of the transaction are shown below;" .
            "\n{$paymentDetails}" .
            "\nDescription: {$dp->Description}" .
            "\nTotal Amount: {$currency}{$dp->amount}" .
            "\nDate: {$date}" .
            "\nAvailable Balance: {$currency}{$dp->bal}";

        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message
            ]);
        } catch (Exception $e) {
            Log::error('SMS sending failed: ' . $e->getMessage());
            // Continue execution even if SMS fails
        }
    }

    /**
     * Export transactions to PDF
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportTransactions(Request $request)
    {
        try {
            // Handle the test request
            if ($request->has('test') && $request->input('test') === true) {
                return response()->json(['success' => true, 'message' => 'Export endpoint is working!']);
            }
            
            // Validate request
            $validator = Validator::make($request->all(), [
                'exportType' => 'required|in:pdf',
                'exportAs' => 'required|in:download,email,view',
                'startDate' => 'nullable|date',
                'endDate' => 'nullable|date',
                'dateFrom' => 'nullable|date',
                'dateTo' => 'nullable|date',
                'status' => 'nullable|string',
                'statementStyle' => 'nullable|string|in:modern,classic',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid export parameters',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();
            $settings = $this->getSettings();
            
            // Query withdrawals
            $withdrawals = Withdrawal::where('user', $user->id);
            
            // Apply filters if provided - support both parameter naming conventions
            if ($request->filled('dateFrom') || $request->filled('startDate')) {
                $date = $request->filled('dateFrom') ? $request->dateFrom : $request->startDate;
                $withdrawals->whereDate('created_at', '>=', $date);
            }
            
            if ($request->filled('dateTo') || $request->filled('endDate')) {
                $date = $request->filled('dateTo') ? $request->dateTo : $request->endDate;
                $withdrawals->whereDate('created_at', '<=', $date);
            }
            
            if ($request->filled('status')) {
                $withdrawals->where('status', $request->status);
            }
            
            // Order results
            $withdrawals->orderBy('created_at', $request->input('orderBy', 'desc'));
            
            // Get final results
            $transactions = $withdrawals->get();
            
            // Calculate statement summary information
            $statementData = $this->calculateStatementData($user, $transactions, $request);
            
            // For view or download options, return the view
            // Client-side JavaScript will handle PDF generation for download
            if ($request->exportAs == 'view' || $request->exportAs == 'download') {
                return view('pdfs.statement', $statementData);
            }
            
            // For email option
            if ($request->exportAs == 'email') {
                try {
                    // Generate HTML content
                    $htmlContent = view('pdfs.statement', $statementData)->render();
                    
                    Mail::send('emails.export', [
                        'user' => $user,
                        'exportType' => 'PDF Statement',
                    ], function ($message) use ($user, $htmlContent) {
                        $message->to($user->email)
                            ->subject('Your Account Statement')
                            ->attachData($htmlContent, 'account_statement.pdf', [
                                'mime' => 'application/pdf',
                            ]);
                    });
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Your account statement has been sent to your email.'
                    ]);
                } catch (Exception $e) {
                    Log::error('Error sending email: ' . $e->getMessage());
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to send email. Please try again later or download directly.'
                    ], 500);
                }
            }
        } catch (Exception $e) {
            Log::error('Error in exportTransactions: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate statement data including summary figures
     * 
     * @param User $user
     * @param Collection $transactions
     * @param Request $request
     * @return array
     */
    private function calculateStatementData($user, $transactions, $request)
    {
        $settings = $this->getSettings();
        
        // Calculate totals
        $totalCredits = $transactions->where('type', 'Credit')->sum('amount');
        $totalDebits = $transactions->where('type', '!=', 'Credit')->sum('amount');
        
        // Get statement period
        $dateFrom = $request->filled('dateFrom') ? Carbon::parse($request->dateFrom) : 
                   ($request->filled('startDate') ? Carbon::parse($request->startDate) : null);
                   
        $dateTo = $request->filled('dateTo') ? Carbon::parse($request->dateTo) : 
                 ($request->filled('endDate') ? Carbon::parse($request->endDate) : null);
        
        // If dates are provided, calculate opening balance as of dateFrom
        $openingBalance = 0;
        if ($dateFrom) {
            // Get all transactions before dateFrom
            $previousTransactions = Withdrawal::where('user', $user->id)
                ->whereDate('created_at', '<', $dateFrom)
                ->get();
            
            // Calculate opening balance
            $previousCredits = $previousTransactions->where('type', 'Credit')->sum('amount');
            $previousDebits = $previousTransactions->where('type', '!=', 'Credit')->sum('amount');
            $openingBalance = $previousCredits - $previousDebits;
        }
        
        // Calculate closing balance
        $closingBalance = $openingBalance + $totalCredits - $totalDebits;
        
        return [
            'user' => $user,
            'settings' => $settings,
            'transactions' => $transactions,
            'totalCredits' => $totalCredits,
            'totalDebits' => $totalDebits,
            'openingBalance' => $openingBalance,
            'closingBalance' => $closingBalance,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'statementStyle' => $request->input('statementStyle', 'modern'),
            'currency' => $user->s_curr ?? $settings->currency
        ];
    }

    /**
     * Get settings with error handling
     * 
     * @return Settings
     */
    private function getSettings()
    {
        $settings = Settings::first();
        if (!$settings) {
            // Create default settings if none exist
            $settings = new Settings();
            $settings->site_name = 'Banking System';
            $settings->save();
        }
        return $settings;
    }

    /**
     * Generate a random string for various codes
     * 
     * @param int $length Length of the string to generate
     * @return string
     */
    private function RandomStringGenerator($length)
    {
        $generated_string = "";
        $domain = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, $len - 1);
            $generated_string .= $domain[$index];
        }
        
        return $generated_string;
    }
    
    
     private function RandomnumbrGenerator($length)
    {
        $generated_string = "";
        $domain = "123456789000876543218765432109654333222";
        $len = strlen($domain);
        
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, $len - 1);
            $generated_string .= $domain[$index];
        }
        
        return $generated_string;
    }
    
    /**
     * Get the current Bitcoin price in the user's currency
     * Uses multiple API endpoints for reliability with intelligent fallback
     * 
     * @param string|null $currency Currency code (default: user's currency)
     * @return float
     */
    private function getBitcoinPrice($currency = null)
    {
        // If no currency is specified, use the authenticated user's currency
        if (!$currency) {
            $user = Auth::user();
            $currency = $user->curr ?? 'USD';
        }
        
        // Normalize currency code to uppercase
        $currency = strtoupper($currency);
        
        // Try multiple APIs in order of preference
        $apis = [
            'coingecko' => 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=' . strtolower($currency),
            'coinapi' => 'https://rest.coinapi.io/v1/exchangerate/BTC/' . $currency,
            'binance' => 'https://api.binance.com/api/v3/ticker/price?symbol=BTC' . ($currency === 'USD' ? 'USDT' : $currency),
            'kraken' => 'https://api.kraken.com/0/public/Ticker?pair=XBTEUR'
        ];
        
        foreach ($apis as $apiName => $apiUrl) {
            try {
                $price = $this->fetchBitcoinPriceFromAPI($apiName, $apiUrl, $currency);
                if ($price > 0) {
                    Log::info("Bitcoin price fetched successfully from {$apiName}: {$price} {$currency}");
                    return $price;
                }
            } catch (\Exception $e) {
                Log::warning("Failed to fetch Bitcoin price from {$apiName}: " . $e->getMessage());
                continue;
            }
        }
        
        // If all APIs fail, try to get USD price and convert
        if ($currency !== 'USD') {
            try {
                $usdPrice = $this->getBitcoinPriceUSD();
                if ($usdPrice > 0) {
                    $exchangeRate = $this->getExchangeRate('USD', $currency);
                    $convertedPrice = $usdPrice * $exchangeRate;
                    Log::info("Bitcoin price converted from USD: {$convertedPrice} {$currency}");
                    return $convertedPrice;
                }
            } catch (\Exception $e) {
                Log::error('Failed to convert Bitcoin price from USD: ' . $e->getMessage());
            }
        }
        
        // Return fallback values if all APIs fail
        $fallbackRates = [
            'USD' => 43000.00,  // Updated realistic fallback
            'EUR' => 39500.00,
            'GBP' => 34000.00,
            'JPY' => 6450000.00,
            'CAD' => 58000.00,
            'AUD' => 64500.00,
            'CNY' => 310000.00,
            'INR' => 3600000.00,
            'NGN' => 67000000.00,
            'GHS' => 520000.00,
            'ZAR' => 780000.00,
        ];
        
        $fallbackPrice = $fallbackRates[$currency] ?? 43000.00;
        Log::warning("Using fallback Bitcoin price: {$fallbackPrice} {$currency}");
        return $fallbackPrice;
    }
    
    /**
     * Fetch Bitcoin price from a specific API
     * 
     * @param string $apiName Name of the API
     * @param string $apiUrl API endpoint URL
     * @param string $currency Target currency
     * @return float Bitcoin price or 0 if failed
     */
    private function fetchBitcoinPriceFromAPI($apiName, $apiUrl, $currency)
    {
        $context = stream_context_create([
            'http' => [
                'timeout' => 10, // 10 second timeout
                'user_agent' => 'Banking-System/1.0',
                'header' => [
                    'Accept: application/json',
                    'Content-Type: application/json'
                ]
            ]
        ]);
        
        $response = file_get_contents($apiUrl, false, $context);
        if (!$response) {
            return 0;
        }
        
        $data = json_decode($response, true);
        if (!$data) {
            return 0;
        }
        
        switch ($apiName) {
            case 'coingecko':
                return $data['bitcoin'][strtolower($currency)] ?? 0;
                
            case 'coinapi':
                return $data['rate'] ?? 0;
                
            case 'binance':
                if ($currency === 'USD') {
                    return floatval($data['price'] ?? 0);
                }
                // For other currencies, Binance might not have direct pairs
                return 0;
                
            case 'kraken':
                if ($currency === 'EUR') {
                    $ticker = $data['result']['XXBTZEUR'] ?? null;
                    if ($ticker && isset($ticker['c'][0])) {
                        return floatval($ticker['c'][0]);
                    }
                }
                return 0;
                
            default:
                return 0;
        }
    }
    
    /**
     * Get Bitcoin price specifically in USD using multiple sources
     * 
     * @return float Bitcoin price in USD
     */
    private function getBitcoinPriceUSD()
    {
        $usdApis = [
            'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd',
            'https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT',
            'https://api.coinbase.com/v2/spot-price/BTC-USD',
        ];
        
        foreach ($usdApis as $apiUrl) {
            try {
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 8,
                        'user_agent' => 'Banking-System/1.0'
                    ]
                ]);
                
                $response = file_get_contents($apiUrl, false, $context);
                if (!$response) continue;
                
                $data = json_decode($response, true);
                if (!$data) continue;
                
                // Parse response based on API structure
                if (strpos($apiUrl, 'coingecko') !== false) {
                    $price = $data['bitcoin']['usd'] ?? 0;
                } elseif (strpos($apiUrl, 'binance') !== false) {
                    $price = floatval($data['price'] ?? 0);
                } elseif (strpos($apiUrl, 'coinbase') !== false) {
                    $price = floatval($data['data']['amount'] ?? 0);
                } else {
                    continue;
                }
                
                if ($price > 0) {
                    return $price;
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        
        return 0;
    }
    
    /**
     * Get exchange rate between two currencies using multiple reliable APIs
     * 
     * @param string $from Source currency code
     * @param string $to Target currency code
     * @return float Exchange rate
     */
    private function getExchangeRate($from, $to)
    {
        // If same currency, return 1
        if ($from === $to) {
            return 1.0;
        }
        
        // Try multiple currency APIs
        $currencyApis = [
            "https://api.exchangerate-api.com/v4/latest/{$from}",
            "https://api.fixer.io/latest?base={$from}&symbols={$to}",
            "https://open.er-api.com/v6/latest/{$from}",
        ];
        
        foreach ($currencyApis as $apiUrl) {
            try {
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 8,
                        'user_agent' => 'Banking-System/1.0'
                    ]
                ]);
                
                $response = file_get_contents($apiUrl, false, $context);
                if (!$response) continue;
                
                $data = json_decode($response, true);
                if (!$data) continue;
                
                // Parse response based on API structure
                if (isset($data['rates'][$to])) {
                    $rate = floatval($data['rates'][$to]);
                    if ($rate > 0) {
                        Log::info("Exchange rate fetched successfully: {$from} to {$to} = {$rate}");
                        return $rate;
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Failed to fetch exchange rate from {$apiUrl}: " . $e->getMessage());
                continue;
            }
        }
        
        // Enhanced fallback rates with more currencies
        $rates = [
            'USD' => [
                'EUR' => 0.92, 'GBP' => 0.80, 'JPY' => 150.0, 'CAD' => 1.35,
                'AUD' => 1.50, 'CNY' => 7.20, 'INR' => 83.0, 'NGN' => 1560.0,
                'GHS' => 12.0, 'ZAR' => 18.5, 'CHF' => 0.88, 'SEK' => 10.5,
                'NOK' => 10.8, 'DKK' => 6.85, 'PLN' => 4.02, 'CZK' => 22.5,
                'HUF' => 365.0, 'RON' => 4.55, 'BGN' => 1.80, 'HRK' => 6.92,
            ],
            'EUR' => [
                'USD' => 1.09, 'GBP' => 0.87, 'JPY' => 163.0, 'CAD' => 1.47,
                'AUD' => 1.63, 'CNY' => 7.85, 'INR' => 90.0, 'NGN' => 1700.0,
                'GHS' => 13.1, 'ZAR' => 20.2, 'CHF' => 0.96, 'SEK' => 11.4,
                'NOK' => 11.8, 'DKK' => 7.46, 'PLN' => 4.38, 'CZK' => 24.5,
            ],
            'GBP' => [
                'USD' => 1.25, 'EUR' => 1.15, 'JPY' => 187.0, 'CAD' => 1.69,
                'AUD' => 1.87, 'CNY' => 9.00, 'INR' => 104.0, 'NGN' => 1950.0,
                'GHS' => 15.0, 'ZAR' => 23.1, 'CHF' => 1.10, 'SEK' => 13.1,
            ],
            'JPY' => [
                'USD' => 0.0067, 'EUR' => 0.0061, 'GBP' => 0.0053, 'CAD' => 0.009,
                'AUD' => 0.010, 'CNY' => 0.048, 'INR' => 0.55, 'NGN' => 10.4,
            ],
            'CAD' => [
                'USD' => 0.74, 'EUR' => 0.68, 'GBP' => 0.59, 'JPY' => 111.0,
                'AUD' => 1.11, 'CNY' => 5.33, 'INR' => 61.5, 'NGN' => 1155.0,
            ],
            'AUD' => [
                'USD' => 0.67, 'EUR' => 0.61, 'GBP' => 0.53, 'JPY' => 100.0,
                'CAD' => 0.90, 'CNY' => 4.80, 'INR' => 55.3, 'NGN' => 1040.0,
            ],
        ];
        
        // Return the rate if it exists in our fallback data
        if (isset($rates[$from][$to])) {
            $rate = $rates[$from][$to];
            Log::info("Using fallback exchange rate: {$from} to {$to} = {$rate}");
            return $rate;
        }
        
        // If we have the inverse rate, return its reciprocal
        if (isset($rates[$to][$from])) {
            $rate = 1 / $rates[$to][$from];
            Log::info("Using inverse fallback exchange rate: {$from} to {$to} = {$rate}");
            return $rate;
        }
        
        // If we don't have a direct conversion, try to convert via USD
        if ($from !== 'USD' && isset($rates[$from]['USD']) && isset($rates['USD'][$to])) {
            $rate = $rates[$from]['USD'] * $rates['USD'][$to];
            Log::info("Using USD conversion fallback: {$from} to {$to} = {$rate}");
            return $rate;
        }
        
        // Try via EUR if USD conversion not available
        if ($from !== 'EUR' && isset($rates[$from]['EUR']) && isset($rates['EUR'][$to])) {
            $rate = $rates[$from]['EUR'] * $rates['EUR'][$to];
            Log::info("Using EUR conversion fallback: {$from} to {$to} = {$rate}");
            return $rate;
        }
        
        // Default fallback
        Log::warning("No exchange rate found for {$from} to {$to}, using 1.0");
        return 1.0;
    }
}