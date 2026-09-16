<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use App\Models\Settings;

class TwoFactorCode extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The two-factor authentication code.
     *
     * @var string
     */
    public $code;

    /**
     * Create a new notification instance.
     *
     * @param  string  $code
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $settings = Settings::where('id', 1)->first();
        
        return (new MailMessage)
            ->subject(Lang::get('Two-Factor Authentication Code - ' . $settings->site_name))
            ->view('emails.two-factor-code', [
                'user' => $notifiable,
                'code' => $this->code,
                'settings' => $settings,
                'expiration' => 10 // minutes
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'code' => $this->code
        ];
    }
}
