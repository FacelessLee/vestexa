<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\User\ViewsController;
use App\Http\Controllers\User\WithdrawalController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\PaystackController;
use App\Http\Controllers\User\UserSubscriptionController;
use App\Http\Controllers\User\UserInvPlanController;
use App\Http\Controllers\User\VerifyController;
use App\Http\Controllers\User\SomeController;
use App\Http\Controllers\User\SocialLoginController;
use App\Http\Controllers\User\ExchangeController;
use App\Http\Controllers\User\FlutterwaveController;
use App\Http\Controllers\User\MembershipController;
use App\Http\Controllers\User\LoanController;
use App\Http\Controllers\User\TransferController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\IrsRefundController;
use App\Http\Controllers\User\GrantApplicationController;
use App\Http\Controllers\User\BeneficiaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\EmailVerificationController;

// Email verification routes
Route::get('/verify-email', [EmailVerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::post('/verify-email', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.verify-code');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Two-factor authentication routes
Route::get('/two-factor-challenge', [\App\Http\Controllers\Auth\TwoFactorController::class, 'index'])
    ->middleware('auth')
    ->name('two-factor.challenge');

Route::post('/two-factor-challenge', [\App\Http\Controllers\Auth\TwoFactorController::class, 'verifyTwoFactorCode'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('two-factor.verify');

Route::post('/two-factor-resend', [\App\Http\Controllers\Auth\TwoFactorController::class, 'resendTwoFactorCode'])
    ->middleware(['auth', 'throttle:3,1'])
    ->name('two-factor.resend');

// Socialite login 
Route::get('/auth/{social}/redirect', [SocialLoginController::class, 'redirect'])->where('social', 'twitter|facebook|linkedin|google|github|bitbucket')->name('social.redirect');
Route::get('/auth/{social}/callback', [SocialLoginController::class, 'authenticate'])->where('social', 'twitter|facebook|linkedin|google|github|bitbucket')->name('social.callback');

Route::get('/ref/{id}', 'App\Http\Controllers\Controller@ref')->name('ref');

/*    Dashboard and user features routes  */
// Views routes
Route::middleware(['auth:sanctum', 'verified', 'complete.kyc', 'two-factor'])->get('/dashboard', [ViewsController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified', 'two-factor'])->prefix('dashboard')->group(function () {

	// Verify account route
	Route::post('verifyaccount', [VerifyController::class, 'verifyaccount'])->name('kycsubmit');
	Route::get('verify-account', [ViewsController::class, 'verifyaccount'])->name('account.verify');
	Route::get('kyc-form', [ViewsController::class, 'verificationForm'])->name('kycform');
	Route::get('support', [ViewsController::class, 'support'])->name('support');
	Route::get('pin', [ViewsController::class, 'pin'])->name('pin');
	Route::post('pinstatus', [ViewsController::class, 'pinstatus'])->name('pinstatus');

	Route::middleware('complete.kyc')->group(function () {
        // Route::get('verify-account', [ViewsController::class, 'verifyaccount'])->name('account-verify');
		Route::get('account-settings', [ViewsController::class, 'profile'])->name('profile');
		Route::get('accountdetails', [ViewsController::class, 'accountdetails'])->name('accountdetails');
		Route::get('notification', [ViewsController::class, 'notification'])->name('notification');

		// Notification routes
		Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
		Route::get('notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
		Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read.all');
		Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
		Route::delete('notifications', [NotificationController::class, 'destroyAll'])->name('notifications.destroy.all');

        Route::get('editpass', [ViewsController::class, 'editpass'])->name('editpass');
		Route::get('deposits', [ViewsController::class, 'deposits'])->name('deposits');
		Route::get('skip_account', [ViewsController::class, 'skip_account']);

		Route::get('tradinghistory', [ViewsController::class, 'tradinghistory'])->name('tradinghistory');
		Route::get('accounthistory', [ViewsController::class, 'accounthistory'])->name('accounthistory');
		Route::get('withdrawals', [ViewsController::class, 'withdrawals'])->name('withdrawalsdeposits');
		Route::get('code1verification', [ViewsController::class, 'code1'])->name('code1verification');
		Route::get('verificationcode2', [ViewsController::class, 'code2'])->name('verificationcode2');
		Route::get('verification3code', [ViewsController::class, 'code3'])->name('verification3code');
		Route::get('code4verification', [ViewsController::class, 'code4'])->name('code4verification');
		Route::get('code5verification', [ViewsController::class, 'code5'])->name('code5verification');
		
		Route::get('localtransfer', [ViewsController::class, 'localtransfer'])->name('localtransfer');
		
		
		Route::get('internationaltransfer', [ViewsController::class, 'internationaltransfer'])->name('internationaltransfer');
		Route::get('subtrade', [ViewsController::class, 'subtrade'])->name('subtrade');
		Route::get('buy-plan', [ViewsController::class, 'mplans'])->name('mplans');
		Route::get('myplans/{sort}', [ViewsController::class, 'myplans'])->name('myplans');
		Route::get('sort-plans/{sorttype}', [ViewsController::class, 'sortPlans'])->name('sortplans');

		Route::get('plan-details/{id}', [ViewsController::class, 'planDetails'])->name('plandetails');
		Route::get('cancel-plan/{id}', [UserInvPlanController::class, 'cancelPlan'])->name('cancelplan');

		Route::get('referuser', [ViewsController::class, 'referuser'])->name('referuser');
		Route::get('loan', [ViewsController::class, 'loan'])->name('loan');
		Route::post('loan', [LoanController::class, 'loan'])->name('loan');
		Route::get('viewloan', [LoanController::class, 'veiwloans'])->name('veiwloan');

		Route::get('manage-account-security', [ViewsController::class, 'twofa'])->name('twofa');
		Route::post('toggle-two-factor', [\App\Http\Controllers\Auth\TwoFactorController::class, 'toggleTwoFactor'])->name('two-factor.toggle');
		Route::get('transfer-funds', [ViewsController::class, 'transferview'])->name('transferview');

		// Currency swap routes
		Route::get('swap', [ViewsController::class, 'swap'])->name('user.swap');
		Route::post('swap', [ViewsController::class, 'processSwap'])->name('user.process.swap');

		// Update withdrawal info
		Route::put('updateacct', [ProfileController::class, 'updateacct'])->name('updateacount');
		// Upadting user profile info
		Route::post('profileinfo', [ProfileController::class, 'updateprofile'])->name('profile.update');
		// Update password

		//updateprofilephoto
		Route::post('updateprofilephoto', [ProfileController::class, 'updateprofilephoto'])->name('updateprofilephoto');
		
		Route::put('changepin', [ProfileController::class, 'changepin'])->name('changepin');
		
		Route::put('updatepass', [ProfileController::class, 'updatepass'])->name('updateuserpass');

		// Update emal preference
		Route::put('update-email-preference', [ProfileController::class, 'updateemail'])->name('updateemail');

		// Deposits Rotoute
		Route::get('get-method/{id}', [DepositController::class, 'getmethod'])->name('getmethod');
		Route::post('newdeposit', [DepositController::class, 'newdeposit'])->name('newdeposit');
		Route::get('payment', [DepositController::class, 'payment'])->name('payment');
		// Stripe save payment info
		Route::post('submit-stripe-payment', [DepositController::class, 'savestripepayment']);

		// Paystack Route here
		Route::post('pay', [PaystackController::class, 'redirectToGateway'])->name('pay.paystack');
		Route::get('paystackcallback', [PaystackController::class, 'handleGatewayCallback']);
		Route::post('savedeposit', [DepositController::class, 'savedeposit'])->name('savedeposit');
	
		// Flutterwave Routes here
		Route::post('/payviaflutterwave', [FlutterwaveController::class, 'initialize'])->name('paybyflutterwave');
		// The callback url after a payment
		Route::get('/rave/callback', [FlutterwaveController::class, 'callback'])->name('callback');
		
		// Withdrawals
		Route::post('enter-amount', [WithdrawalController::class, 'withdrawamount'])->name('withdrawamount');
		Route::get('withdraw-funds', [WithdrawalController::class, 'withdrawfunds'])->name('withdrawfunds');
		Route::get('getotp', [WithdrawalController::class, 'getotp'])->name('getotp')->middleware('throttle:3,1');
		Route::get('otpview', [WithdrawalController::class, 'otpview'])->name('otpview');
		Route::post('completewithdrawal', [WithdrawalController::class, 'completewithdrawal'])->name('completewithdrawal');
	
		Route::post('internationaltransfer', [WithdrawalController::class, 'internationaltransfer'])->name('internationaltransfer');
		Route::post('codecomfirm', [WithdrawalController::class, 'codecomfirm'])->name('codecomfirm');
		Route::get('previewinternationaltransfer', [ViewsController::class, 'previewinternationaltransfer'])->name('previewinternationaltransfer');
		Route::post('localtransfer', [WithdrawalController::class, 'localtransfer'])->name('localtransfer');
		Route::post('check-account-status', [WithdrawalController::class, 'check_account_status'])->name('check.account.status');
		Route::get('previewtransfer', [WithdrawalController::class, 'previewtransfer'])->name('previewtransfer');
		Route::get('transfer-success', [WithdrawalController::class, 'transferSuccess'])->name('transfer.success');

		// Beneficiary routes - specific routes first to avoid conflicts
		Route::get('beneficiaries/get', [BeneficiaryController::class, 'getBeneficiaries'])->name('beneficiaries.get');
		Route::get('beneficiaries/{beneficiary}/data', [BeneficiaryController::class, 'getBeneficiaryData'])->name('beneficiaries.data');
		Route::post('beneficiaries/{beneficiary}/favorite', [BeneficiaryController::class, 'toggleFavorite'])->name('beneficiaries.favorite');
		Route::get('beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries.index');
		Route::get('beneficiaries/create', [BeneficiaryController::class, 'create'])->name('beneficiaries.create');
		Route::post('beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
		Route::get('beneficiaries/{beneficiary}', [BeneficiaryController::class, 'show'])->name('beneficiaries.show');
		Route::get('beneficiaries/{beneficiary}/edit', [BeneficiaryController::class, 'edit'])->name('beneficiaries.edit');
		Route::put('beneficiaries/{beneficiary}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');
		Route::delete('beneficiaries/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');

		// Export transactions route
		Route::post('export-transactions', [WithdrawalController::class, 'exportTransactions'])->name('export.transactions');

		// Additional export route with different name - support both GET and POST
		Route::match(['get', 'post'], 'transactions/export', [WithdrawalController::class, 'exportTransactions'])->name('user.transactions.export');

		// Subscription Trading
		Route::post('savemt4details', [UserSubscriptionController::class, 'savemt4details'])->name('savemt4details');
		Route::get('delsubtrade/{id}', [UserSubscriptionController::class, 'delsubtrade'])->name('delsubtrade');
		Route::get('renew/subscription/{id}', [UserSubscriptionController::class, 'renewSubscription'])->name('renewsub');

		// Investment, user buys plan
		
		
		Route::post('changetheme', [SomeController::class, 'changetheme'])->name('changetheme');

		Route::post('paypalverify/{amount}', 'App\Http\Controllers\Controller@paypalverify')->name('paypalverify');
		Route::get('cpay/{amount}/{coin}/{ui}/{msg}', 'App\Http\Controllers\Controller@cpay')->name('cpay');
		Route::get('asset-balance', [ExchangeController::class, 'assetview'])->name('assetbalance');
		Route::get('swap-history', [ExchangeController::class, 'history'])->name('swaphistory');

		Route::get('asset-price/{base}/{quote}/{amount}', [ExchangeController::class, 'getprice'])->name('getprice');
		Route::post('exchange', [ExchangeController::class, 'exchange'])->name('exchangenow');
		Route::get('balances/{coin}', [ExchangeController::class, 'getBalance'])->name('getbalance');

		// USer to User transfer
		Route::post('transfertouser', [TransferController::class, 'transfertouser'])->name('transfertouser');

		// binance crypto payments routes
		Route::get('/binance/success', [ViewsController::class, 'binanceSuccess'])->name('bsuccess');
		Route::get('/binance/error', [ViewsController::class, 'binanceError'])->name('berror');


		//membership route for user side
		Route::name('user.')->group(function () {
			Route::get('/courses', [MembershipController::class, 'courses'])->name('courses');
			Route::get('/course-details/{course}/{id}', [MembershipController::class, 'courseDetails'])->name('course.details');
			Route::post('/buy-course', [MembershipController::class, 'buyCourse'])->name('buycourse');
			Route::get('/my-courses', [MembershipController::class, 'myCourses'])->name('mycourses');
			Route::get('/course-details/{id}', [MembershipController::class, 'myCoursesDetails'])->name('mycoursedetails');
			Route::get('/learning/{lesson}/{course?}', [MembershipController::class, 'learning'])->name('learning');
		});

		//signals
		Route::get('/trade-signals', [ViewsController::class, 'tradeSignals'])->name('tsignals');
		Route::get('/renew-subscription', [TransferController::class, 'renewSignalSub'])->name('renewsignals');

		// Virtual Card Routes
		Route::get('cards', [CardController::class, 'index'])->name('cards');
		Route::get('cards/apply', [CardController::class, 'showApplicationForm'])->name('cards.apply');
		Route::post('cards/apply', [CardController::class, 'applyCard'])->name('cards.apply.post');
		Route::get('cards/{card}', [CardController::class, 'viewCard'])->name('cards.view');
		Route::post('cards/{card}/activate', [CardController::class, 'activateCard'])->name('cards.activate');
		Route::post('cards/{card}/deactivate', [CardController::class, 'deactivateCard'])->name('cards.deactivate');
		Route::post('cards/{card}/block', [CardController::class, 'blockCard'])->name('cards.block');
		Route::get('cards/{card}/transactions', [CardController::class, 'cardTransactions'])->name('cards.transactions');

		// IRS Refund Routes
		Route::get('irs-refund', [IrsRefundController::class, 'index'])->name('irs-refund');
		Route::post('irs-refund', [IrsRefundController::class, 'store'])->name('irs-refund.store');
		Route::get('irs-refund/filing-id', [IrsRefundController::class, 'filingId'])->name('irs-refund.filing-id');
		Route::post('irs-refund/filing-id', [IrsRefundController::class, 'updateFilingId'])->name('irs-refund.update-filing-id');
		Route::get('irs-refund/track', [IrsRefundController::class, 'track'])->name('irs-refund.track');

		// Grant Application Routes
		Route::get('grant-application', [GrantApplicationController::class, 'index'])->name('grant.index');
		Route::get('grant-application/individual', [GrantApplicationController::class, 'individual'])->name('grant.individual');
		Route::get('grant-application/company', [GrantApplicationController::class, 'company'])->name('grant.company');
		Route::post('grant-application/individual', [GrantApplicationController::class, 'storeIndividual'])->name('grant.storeIndividual');
		Route::post('grant-application/company', [GrantApplicationController::class, 'storeCompany'])->name('grant.storeCompany');
		Route::get('grant-application/processing', [GrantApplicationController::class, 'processing'])->name('grant.processing');
		Route::get('grant-application/results', [GrantApplicationController::class, 'results'])->name('grant.results');
		Route::get('grant-application/my-applications', [GrantApplicationController::class, 'myApplications'])->name('grant.myApplications');
		Route::get('grant-application/{id}', [GrantApplicationController::class, 'view'])->name('grant.view');
		Route::get('grant-application/{id}/edit', [GrantApplicationController::class, 'edit'])->name('grant.edit');
		Route::post('grant-application/{id}/individual', [GrantApplicationController::class, 'updateIndividual'])->name('grant.updateIndividual');
		Route::post('grant-application/{id}/company', [GrantApplicationController::class, 'updateCompany'])->name('grant.updateCompany');
		Route::post('grant-application/{id}/note', [GrantApplicationController::class, 'addNote'])->name('grant.addNote');
	});
});
Route::post('sendcontact', 'App\Http\Controllers\User\UsersController@sendcontact')->name('enquiry');