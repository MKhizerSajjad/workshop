<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\CaseReceivedMail;
use App\Mail\StatusChangeMail;
use App\Mail\CommentAddedMail;
use App\Mail\PaymentMadeMail;

class EmailService
{
    public function sendEmail($type, $data)
    {
        switch ($type) {
            case 'case_received':
                return $this->sendCaseReceivedEmail($data);
            case 'status_change':
                return $this->sendStatusChangeEmail($data);
            case 'comment_added':
                return $this->sendCommentAddedEmail($data);
            case 'payment_made':
                return $this->sendPaymentMadeEmail($data);
            default:
                throw new \Exception("Invalid email type");
        }
    }

    protected function sendCaseReceivedEmail($data)
    {
        Mail::to($data['customer_email'])->send(new CaseReceivedMail($data));
    }

    protected function sendStatusChangeEmail($data)
    {
        Mail::to($data['customer_email'])->send(new StatusChangeMail($data));
    }

    protected function sendCommentAddedEmail($data)
    {
        Mail::to($data['customer_email'])->send(new CommentAddedMail($data));
    }

    protected function sendPaymentMadeEmail($data)
    {
        Mail::to($data['customer_email'])->send(new PaymentMadeMail($data));
    }
}
