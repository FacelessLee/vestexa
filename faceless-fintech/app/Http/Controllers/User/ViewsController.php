<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CryptoAccount;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\User_plans;
use App\Models\Mt4Details;
use App\Models\Deposit;
use App\Models\SettingsCont;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Tp_Transaction;
use App\Traits\PingServer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\Apitrait;

class ViewsController extends Controller
{
    use PingServer;
    use Apitrait;

    public function dashboard(Request $request)
    {

        $settings = Settings::where('id', '1')->first();
        $user = User::find(auth()->user()->id);

        //check if user does not have ref link then update his link
        if ($user->ref_link == '') {
            User::where('id', $user->id)
                ->update([
                    'ref_link' => $settings->site_address . '/ref/' . $user->username,
                ]);
        }

        //give reg bonus if new
        if ($user->signup_bonus != "received" && ($settings->signup_bonus != NULL && $settings->signup_bonus > 0)) {
            User::where('id', $user->id)
                ->update([
                    'bonus' => $user->bonus + $settings->signup_bonus,
                    'account_bal' => $user->account_bal + $settings->signup_bonus,
                    'signup_bonus' => "received",
                ]);
            //create history
            Tp_Transaction::create([
                'user' => Auth::user()->id,
                'plan' => "SignUp Bonus",
                'amount' => $settings->signup_bonus,
                'type' => "Bonus",
            ]);
        }

        if (DB::table('crypto_accounts')->where('user_id', Auth::user()->id)->doesntExist()) {
            $cryptoaccnt = new CryptoAccount();
            $cryptoaccnt->user_id = Auth::user()->id;
            $cryptoaccnt->save();
        }

        //sum total deposited
        $total_deposited = DB::table('deposits')->where('user', $user->id)->where('status', 'Processed')->sum('amount');
        $total_deposited_pending = DB::table('deposits')->where('user', $user->id)->where('status', 'Pending')->sum('amount');
        $total_withdrawal = DB::table('withdrawals')->where('user', $user->id)->where('status', 'Processed')->sum('amount');
        $total_withdrawal_pending = DB::table('withdrawals')->where('user', $user->id)->where('status', 'Pending')->sum('amount');
        //log user out if not blocked by admin
        if ($user->status != "active") {
            $request->session()->flush();
            return redirect()->route('dashboard');
        }
        // Get BTC price from an API or use a fixed rate for demo purposes
        // In a production environment, you should use a real-time API
        $btc_rate = $this->get_rate('btc', 'usd');
        
        // Calculate monthly deposits and expenses for the current month
        $current_month = date('m');
        $current_year = date('Y');
        $monthly_deposits = Deposit::where('user', Auth::user()->id)
            ->where('status', 'Processed')
            ->whereMonth('created_at', $current_month)
            ->whereYear('created_at', $current_year)
            ->sum('amount');
            
        $monthly_expenses = Withdrawal::where('user', Auth::user()->id)
            ->where('status', 'Processed')
            ->whereMonth('date', $current_month)
            ->whereYear('date', $current_year)
            ->sum('amount');
        
        return view('user.dashboard', [
            'title' => 'Customer Dashboard',
            'total_deposited' => $total_deposited,
            'total_withdrawal' => $total_withdrawal,
            'total_withdrawal_pending'=> $total_withdrawal_pending,
            'total_deposited_pending' => $total_deposited_pending,
            'btc_rate' => $btc_rate,
            'monthly_deposits' => $monthly_deposits,
            'monthly_expenses' => $monthly_expenses,
            'withdrawals' => Withdrawal::where('user', Auth::user()->id)->orderBy('id', 'desc')->take(6)
                    ->get(),
            'cards' => \App\Models\Card::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get(),
            'deposits' =>Deposit::where('user', Auth::user()->id)->orderBy('id', 'desc')->take(4)
                    ->get(),
            'trading_accounts' => Mt4Details::where('client_id', Auth::user()->id)->count(),
            'plans' => User_plans::where('user', Auth::user()->id)->where('active', 'yes')->orderByDesc('id')->skip(0)->take(2)->get(),
            't_history' => Tp_Transaction::where('user', Auth::user()->id)
                ->where('type', '<>', 'ROI')
                ->orderByDesc('id')->skip(0)->take(10)
                ->get(),
        ]);
    }

    //Profile route
    public function profile()
    {
        $userinfo = User::where('id', Auth::user()->id)->first();
        return view('user.profile')->with(array(
            'userinfo' => $userinfo,
            'title' => 'Profile',
        ));
    }

    // editpass

    public function editpass()
    {
        $userinfo = User::where('id', Auth::user()->id)->first();
        return view('user.editpass')->with(array(
            'userinfo' => $userinfo,
            'title' => 'Reset Password',
        ));
    }

    //return add withdrawal account form view
    public function accountdetails()
    {
        return view('user.updateacct')->with(array(
            'title' => 'Update account details',
        ));
    }

//return localtransfer account form view
public function localtransfer()
{
    $user = Auth::user();
    return view('user.localtransfer')->with(array(
        'title' => 'Local Transfer',
        'user' => $user,
    ));
}
//return code1 account form view
public function code1()

{
    if(auth::user()->transferaction==1){
       return back();
    }
    return view('user.code1')->with(array(
        'title' => 'Transfer Code',
    ));
}

//return code2 account form view
public function code2()
{
     if(auth::user()->transferaction==1){
       return back();
    }
    return view('user.code2')->with(array(
        'title' => 'Transfer Code',
    ));
}


//return code3 account form view
public function code3()
{
     if(auth::user()->transferaction==1){
       return back();
    }
    return view('user.code3')->with(array(
        'title' => 'Transfer Code',
    ));
}

//return code4 account form view
public function code4()
{
     if(auth::user()->transferaction==1){
       return back();
    }
    return view('user.code4')->with(array(
        'title' => 'Transfer Code',
    ));
}

//return code5 account form view
public function code5()
{
     if(auth::user()->transferaction==1){
       return back();
    }
    return view('user.code5')->with(array(
        'title' => 'Transfer Code',
    ));
}


//return add international Transfer account form view
public function internationaltransfer()
{
    // Get Bitcoin price in user's currency
    $btc_rate = $this->getBitcoinPrice();
    $user = Auth::user();
    
    return view('user.international')->with(array(
        'title' => 'International Transfer',
        'btc_rate' => $btc_rate,
        'user' => $user,
    ));
}
    //support route
    public function support()
    {
        return view('user.support')
            ->with(array(
                'title' => 'Support',
            ));
    }


     //pin route
     public function pin()
     {
         return view('user.pin')
             ->with(array(
                 'title' => 'Verify Pin',
             ));
     }

    //Trading history route
    public function tradinghistory()
    {
        return view('user.thistory')
            ->with(array(
                't_history' => Tp_Transaction::where('user', Auth::user()->id)
                    ->where('type', 'ROI')
                    ->orderByDesc('id')
                    ->paginate(15),
                'title' => 'Trading History',
            ));
    }

    //Account transactions history route
  public function accounthistory(Request $request)
{
    // Get filter parameters
    $search = $request->input('search');
    $dateFrom = $request->input('date_from');
    $dateTo = $request->input('date_to');
    $status = $request->input('status');
    $orderBy = $request->input('order', 'desc');
    $perPage = $request->input('per_page', 15); // Default 15 per page
    
    // Start with base queries
    $withdrawalsQuery = Withdrawal::where('user', Auth::user()->id);
    $depositsQuery = Deposit::where('user', Auth::user()->id);
    
    // Apply search if provided
    if ($search) {
        $withdrawalsQuery->where('txn_id', 'like', "%{$search}%");
        $depositsQuery->where('txn_id', 'like', "%{$search}%");
    }
    
    // Apply date filters if provided
    if ($dateFrom) {
        $withdrawalsQuery->whereDate('created_at', '>=', $dateFrom);
        $depositsQuery->whereDate('created_at', '>=', $dateFrom);
    }
    
    if ($dateTo) {
        $withdrawalsQuery->whereDate('created_at', '<=', $dateTo);
        $depositsQuery->whereDate('created_at', '<=', $dateTo);
    }
    
    // Apply status filter if provided
    if ($status) {
        $withdrawalsQuery->where('status', $status);
        $depositsQuery->where('status', $status);
    }
    
    // Apply sorting
    $withdrawalsQuery->orderBy('created_at', $orderBy == 'asc' ? 'asc' : 'desc');
    $depositsQuery->orderBy('created_at', $orderBy == 'asc' ? 'asc' : 'desc');
    
    // Get all records
    $withdrawals = $withdrawalsQuery->get();
    $deposits = $depositsQuery->get();
    
    // Merge the collections and maintain the t_history for compatibility
    $transactions = $withdrawals->concat($deposits);
    
    // Sort the merged collection
    if ($orderBy === 'asc') {
        $transactions = $transactions->sortBy('created_at');
    } else {
        $transactions = $transactions->sortByDesc('created_at');
    }
    
    // Convert to paginator
    $paginatedTransactions = new \Illuminate\Pagination\LengthAwarePaginator(
        $transactions->forPage($request->input('page', 1), $perPage),
        $transactions->count(),
        $perPage,
        $request->input('page', 1),
        ['path' => $request->url(), 'query' => $request->query()]
    );
    
    // Keep t_history for backward compatibility
    $t_history = Tp_Transaction::where('user', Auth::user()->id)
        ->where('type', '<>', 'ROI')
        ->orderByDesc('created_at')
        ->get();
    
    return view('user.transactions', [
        't_history' => $t_history,
        'withdrawals' => $withdrawals, // Keep for backward compatibility
        'deposits' => $deposits, // Keep for backward compatibility
        'transactions' => $paginatedTransactions, // New paginated collection
        'title' => 'Account Transactions History',
    ]);
}

    //Return deposit route
    public function deposits()
    {
        $paymethod = Wdmethod::where(function ($query) {
            $query->where('type', '=', 'deposit')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        //sum total deposited
        $total_deposited = DB::table('deposits')->where('user', auth()->user()->id)->where('status', 'Processed')->sum('amount');

        return view('user.deposits')
            ->with(array(
                'title' => 'Fund your account',
                'dmethods' => $paymethod,
                'deposits' => Deposit::where(['user' => Auth::user()->id])
                    ->orderBy('id', 'desc')
                    ->get(),
                'deposited' => $total_deposited,
            ));
    }

    //Return withdrawals route
    public function withdrawals()
    {
        $withdrawals =  Wdmethod::where(function ($query) {
            $query->where('type', '=', 'withdrawal')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        return view('user.withdrawals')
            ->with(array(
                'title' => 'Withdraw Your funds',
                'wmethods' => $withdrawals,
            ));
    }

    public function transferview()
    {
        $settings = SettingsCont::find(1);
        if (!$settings->use_transfer) {
            abort(404);
        }
        return view('user.transfer', [
            'title' => 'Send funds to a friend',
        ]);
    }

    //Subscription Trading 
    public function subtrade()
    {
        $settings = Settings::where('id', 1)->first();
        $mod = $settings->modules;
        if (!$mod['subscription']) {
            abort(404);
        }
        return view('user.subtrade')
            ->with(array(
                'title' => 'Subscription Trade',
                'subscriptions' => Mt4Details::where('client_id', auth::user()->id)->orderBy('id', 'desc')->get(),
            ));
    }


    //Main Plans route
    public function mplans()
    {
        return view('user.mplans')
            ->with(array(
                'title' => 'Main Plans',
                'plans' => Plans::where('type', 'main')->get(),
                'settings' => Settings::where('id', '1')->first(),
            ));
    }

    //My Plans route
    public function myplans($sort)
    {
        if ($sort == 'All') {
            return view('user.myplans')
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        } else {
            return view('user.myplans')
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->where('active', $sort)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        }
    }


    public function sortPlans($sort)
    {
        return redirect()->route('myplans', ['sort' => $sort]);
    }

    public function planDetails($id)
    {
        $plan = User_plans::find($id);
        return view('user.plandetails', [
            'title' => $plan->dplan->name,
            'plan' => $plan,
            'transactions' => Tp_Transaction::where('type', 'ROI')->where('user_plan_id', $plan->id)->orderByDesc('id')->paginate(10),
        ]);
    }


    function twofa()
    {
        return view('user.twofa', [
            'title' => 'Two-Factor Authentication Settings',
        ]);
    }

    // Referral Page
    public function referuser()
    {
        return view('user.referuser', [
            'title' => 'Refer user',
        ]);
    }

    public function verifyaccount()
    {
        if (Auth::user()->account_verify == 'Verified') {
             return redirect()->route('dashboard')->with('success', 'Congratulations!! Your account has been verified.');
        }
        return view('user.verify', [
            'title' => 'Verify your Account',
        ]);
    }

    public function verificationForm()
    {
        if (Auth::user()->account_verify == 'Verified') {
            return redirect()->route('dashboard')->with('success', 'Congratulations!! Your account has been verified.');
        }
        return view('user.verification', [
            'title' => 'KYC Application'
        ]);
    }



    public function tradeSignals()
    {
        $settings = Settings::where('id', 1)->first();
        $mod = $settings->modules;
        if (!$mod['signal']) {
            abort(404);
        }

        $response = $this->fetctApi('/subscription', [
            'id' => auth()->user()->id
        ]);
        $res = json_decode($response);

        $responseSt = $this->fetctApi('/signal-settings');
        $info = json_decode($responseSt);

        return view('user.signals.subscribe', [
            'title' => 'Trade signals',
            'subscription' => $res->data,
            'set' => $info->data->settings,
        ]);
    }

     //return code1 account form view
public function loan()
{
    return view('user.loan')->with(array(
        'title' => 'Loan Application',
    ));
}
    public function binanceSuccess()
    {
        return redirect()->route('deposits')->with('success', 'Your Deposit was successful, please wait while it is confirmed. You will receive a notification regarding the status of your deposit.');
    }

    public function binanceError()
    {
        return redirect()->route('deposits')->with('message', 'Something went wrong please try again. Contact our support center if problem persist');
    }


    public function pinstatus(Request $request)
{
    $user = Auth::user();
    
    // Validate PIN
    if($request->pin != $user->pin){
        return response()->json([
            'success' => false,
            'message' => 'Invalid PIN. Please try again.'
        ]);
    }
    
    // Update PIN status
    User::where('id', $user->id)
        ->update([
            'pinstatus' => '0'
        ]);
    
    // Return success response
    return response()->json([
        'success' => true,
        'message' => 'PIN verified successfully',
        'redirect' => route('dashboard')
    ]);
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
                \Log::info("Bitcoin price fetched successfully from {$apiName}: {$price} {$currency}");
                return $price;
            }
        } catch (\Exception $e) {
            \Log::warning("Failed to fetch Bitcoin price from {$apiName}: " . $e->getMessage());
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
                \Log::info("Bitcoin price converted from USD: {$convertedPrice} {$currency}");
                return $convertedPrice;
            }
        } catch (\Exception $e) {
            \Log::error('Failed to convert Bitcoin price from USD: ' . $e->getMessage());
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
    \Log::warning("Using fallback Bitcoin price: {$fallbackPrice} {$currency}");
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
                    \Log::info("Exchange rate fetched successfully: {$from} to {$to} = {$rate}");
                    return $rate;
                }
            }
        } catch (\Exception $e) {
            \Log::warning("Failed to fetch exchange rate from {$apiUrl}: " . $e->getMessage());
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
        \Log::info("Using fallback exchange rate: {$from} to {$to} = {$rate}");
        return $rate;
    }
    
    // If we have the inverse rate, return its reciprocal
    if (isset($rates[$to][$from])) {
        $rate = 1 / $rates[$to][$from];
        \Log::info("Using inverse fallback exchange rate: {$from} to {$to} = {$rate}");
        return $rate;
    }
    
    // If we don't have a direct conversion, try to convert via USD
    if ($from !== 'USD' && isset($rates[$from]['USD']) && isset($rates['USD'][$to])) {
        $rate = $rates[$from]['USD'] * $rates['USD'][$to];
        \Log::info("Using USD conversion fallback: {$from} to {$to} = {$rate}");
        return $rate;
    }
    
    // Try via EUR if USD conversion not available
    if ($from !== 'EUR' && isset($rates[$from]['EUR']) && isset($rates['EUR'][$to])) {
        $rate = $rates[$from]['EUR'] * $rates['EUR'][$to];
        \Log::info("Using EUR conversion fallback: {$from} to {$to} = {$rate}");
        return $rate;
    }
    
    // Default fallback
    \Log::warning("No exchange rate found for {$from} to {$to}, using 1.0");
    return 1.0;
}

/**
 * Display the currency swap page
 * 
 * @return \Illuminate\View\View
 */
public function swap()
{
    $btc_rate = $this->getBitcoinPrice();
    $user = Auth::user();
    
    return view('user.swap', [
        'title' => 'Currency Swap',
        'btc_rate' => $btc_rate,
        'user' => $user
    ]);
}

/**
 * Process the currency swap
 * 
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function processSwap(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:0.00000001',
        'from_currency' => 'required|in:fiat,btc',
        'to_currency' => 'required|in:fiat,btc',
    ]);
    
    $user = Auth::user();
    $btc_rate = $this->getBitcoinPrice();
    $amount = $request->amount;
    $from = $request->from_currency;
    $to = $request->to_currency;
    
    // Cannot swap to the same currency
    if ($from === $to) {
        return back()->with('error', 'Cannot swap to the same currency type');
    }
    
    // Swap from fiat to BTC
    if ($from === 'fiat' && $to === 'btc') {
        // Check if user has enough fiat balance
        if ($user->account_bal < $amount) {
            return back()->with('error', 'Insufficient fiat balance');
        }
        
        // Calculate BTC amount to receive
        $btc_to_receive = $amount / $btc_rate;
        
        // Update balances
        $user->account_bal -= $amount;
        $user->btc_balance += $btc_to_receive;
        $user->save();
        
        // Create transaction record
        Tp_Transaction::create([
            'user' => $user->id,
            'plan' => 'Currency Swap',
            'amount' => $amount,
            'type' => 'Swap to BTC',
            'remark' => "Swapped {$user->s_curr}{$amount} {$user->curr} to {$btc_to_receive} BTC"
        ]);
        
        return redirect()->route('dashboard')->with('success', "Successfully swapped {$user->s_curr}{$amount} {$user->curr} to {$btc_to_receive} BTC");
    }
    
    // Swap from BTC to fiat
    if ($from === 'btc' && $to === 'fiat') {
        // Check if user has enough BTC balance
        if ($user->btc_balance < $amount) {
            return back()->with('error', 'Insufficient BTC balance');
        }
        
        // Calculate fiat amount to receive
        $fiat_to_receive = $amount * $btc_rate;
        
        // Update balances
        $user->btc_balance -= $amount;
        $user->account_bal += $fiat_to_receive;
        $user->save();
        
        // Create transaction record
        Tp_Transaction::create([
            'user' => $user->id,
            'plan' => 'Currency Swap',
            'amount' => $fiat_to_receive,
            'type' => 'Swap to Fiat',
            'remark' => "Swapped {$amount} BTC to {$user->s_curr}{$fiat_to_receive} {$user->curr}"
        ]);
        
        return redirect()->route('dashboard')->with('success', "Successfully swapped {$amount} BTC to {$user->s_curr}{$fiat_to_receive} {$user->curr}");
    }
    
    return back()->with('error', 'Invalid swap request');
}
}