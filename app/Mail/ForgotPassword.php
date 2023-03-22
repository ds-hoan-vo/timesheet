<?php

namespace App\Mail;

use App\Models\EmailOtp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $otp;
    public $expired_at;
    public $token;
    public function __construct(EmailOtp $email_otp,  $token)
    {
        $this->email = $email_otp->email;
        $this->otp = $email_otp->otp;
        $this->token = $token;
        $this->expired_at = $email_otp->expired_at;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Forgot Password',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.forgotpasswords',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    public function build()
    {
        return $this->from('hoan-vo@dimage.co.jp', 'Me')
            ->to($this->email)->subject('Forgot Password')->markdown('emails.forgotpasswords')->with([
                'otp' => $this->otp,
                'email' => $this->email,
                'expired_at' => $this->expired_at
            ]);
    }
}