<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Models\Settings;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $settings = Settings::where('id', 1)->first();

        if ($settings->enable_verification == 'true') {
            // Generate a random verification code
            $code = mt_rand(100000, 999999);

            // Store the verification code and expiry in database
            $this->verification_code = $code;
            $this->verification_code_expires_at = now()->addMinutes(60);
            $this->save();

            // Send the notification with the code
            $this->notify(new \App\Notifications\VerifyEmailWithCode($code));
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'lastname',
        'middlename',
        'phone',
        'username',
        'country',
        'curr',
        's_curr',
        'accounttype',
        'btc_address',
        'eth_address',
        'ltc_address',
        'usdt_address',
        'pin',
        'ref_by',
        'status',
        'usernumber',
        'code1',
        'code2',
        'code3',
        'code4',
        'code5',
        'password',
        'dob',
        'address',
        'bank_name',
        'account_name',
        'account_number',
        'profile_photo_path',
        'withdrawotp',
        'sendotpemail',
        'sendroiemail',
        'sendinvplanemail',
        'is_banned',
        'ban_message',
        'banned_at',
        'ban_expires_at',
        'banned_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'two_factor_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verification_code_expires_at' => 'datetime',
        'two_factor_expires_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'grant_limit' => 'decimal:2',
        'min_transfer_amount' => 'decimal:2',
        'max_transfer_amount' => 'decimal:2',
        'is_banned' => 'boolean',
        'banned_at' => 'datetime',
        'ban_expires_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Verify the user's email with the given code.
     *
     * @param  string  $code
     * @return bool
     */
    public function verifyEmailWithCode($code)
    {
        // Check if code matches and is not expired
        if ($this->verification_code == $code &&
            $this->verification_code_expires_at &&
            now()->lt($this->verification_code_expires_at)) {

            // Mark email as verified and reset the code
            $this->email_verified_at = now();
            $this->verification_code = null;
            $this->verification_code_expires_at = null;
            $this->save();

            return true;
        }

        return false;
    }

    public function dp(){
    	return $this->hasMany(Deposit::class, 'user');
    }

    public function wd(){
    	return $this->hasMany(Withdrawal::class, 'user');
    }

    public function tuser(){
    	return $this->belongsTo(Admin::class, 'assign_to');
    }

    public function dplan(){
    	return $this->belongsTo(Plans::class, 'plan');
    }

    public function plans(){
        return $this->hasMany(User_plans::class,'user', 'id');
    }

    public static function search($search): \Illuminate\Database\Eloquent\Builder
    {
        return empty($search) ? static::query()
        : static::query()->where('id', 'like', '%'.$search.'%')
        ->orWhere('name', 'like', '%'.$search.'%')
        ->orWhere('username', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%');
    }

    /**
     * Get the cards for the user.
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * Get the notifications associated with the user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the count of unread notifications for this user.
     *
     * @return int
     */
    public function unreadNotificationsCount()
    {
        return $this->notifications()->where('is_read', false)->count();
    }

    /**
     * Generate a new two-factor authentication code for the user.
     *
     * @return void
     */
    public function generateTwoFactorCode()
    {
        // Generate a random verification code
        $code = mt_rand(100000, 999999);

        // Store the verification code and expiry in database
        $this->two_factor_code = $code;
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();

        // Send the notification with the code
        $this->notify(new \App\Notifications\TwoFactorCode($code));
    }

    /**
     * Reset the two-factor authentication code for the user.
     *
     * @return void
     */
    public function resetTwoFactorCode()
    {
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    /**
     * Get the grant applications for the user.
     */
    public function grantApplications()
    {
        return $this->hasMany(GrantApplication::class);
    }

    /**
     * Get the user plans (loans) for the user.
     */
    public function user_plans()
    {
        return $this->hasMany(User_plans::class, 'user', 'id');
    }

    /**
     * Get the IRS refunds for the user.
     */
    public function irsRefunds()
    {
        return $this->hasMany(IrsRefund::class);
    }

    /**
     * Get the beneficiaries for the user.
     */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    /**
     * Check if the user is currently banned.
     *
     * @return bool
     */
    public function isBanned()
    {
        if (!$this->is_banned) {
            return false;
        }

        // If ban has an expiry date and it has passed, automatically unban
        if ($this->ban_expires_at && $this->ban_expires_at < now()) {
            $this->update([
                'is_banned' => false,
                'ban_message' => null,
                'banned_at' => null,
                'ban_expires_at' => null,
                'banned_by' => null
            ]);
            return false;
        }

        return true;
    }

    /**
     * Get the admin who banned this user.
     */
    public function bannedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'banned_by');
    }

}
