<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class CaseReceivedMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from(
                        config('mail.username'),
                        config('mail.from.name')
                    )
                    ->subject('Your Case Has Been Received')
                    ->view('emails.case_received')
                    ->with($this->data);
    }
}
