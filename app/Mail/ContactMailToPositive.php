<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailToPositive extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->mailData['file']){
            return $this->subject('Email od používateľa')
            ->view('email.contactMailToPositive', $this->mailData)
            ->attach($this->mailData['file']->getRealPath(),[
                'as' => $this->mailData['file']->getClientOriginalName()
            ]);
        }
        else{
            return $this->subject('Email od používateľa')
            ->view('email.contactMailToPositive', $this->mailData);
        }
    }
}
