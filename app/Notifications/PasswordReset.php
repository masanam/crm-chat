<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class PasswordReset extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

		$enkripsi= Crypt::encrypt($notifiable->username);
        $username = $notifiable->username;
        $getlink = $this->token.'?encrypted='.$enkripsi;
        $url = url(config('app.url').route('password.reset', $getlink, false));
        return (new MailMessage)->subject('Reset Login Password')->view('emails.ResetLoginPassword', ['url' => $url, 'username' => $username]);

        // return (new MailMessage)
        //     ->subject('Reset Password Notification')
        //     ->line('You are receiving this email because we received a password reset request for your account.')
        //     ->action('Reset Password', url(config('app.url').route('password.reset', $getlink, false)))
        //     ->line('If you did not request a password reset, no further action is required.');
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
