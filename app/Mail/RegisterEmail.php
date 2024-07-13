<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->type = $data['type'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->phone_number = $data['phone_number'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->view('emails.ActivationUser');
    // }

        /**
     * Build the message.
     *
     * @return $this
     */


    public function build()
    {
        return $this->from('no-reply@pasima.co','Pasima')
                   ->subject('Registration Successful')
                   ->view('emails.RegisterUser')
                   ->with(
                    [
                        'type' => $this->type,
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'email' => $this->email,
                        'phone_number' => $this->phone_number,

                    ]);

    }

}
