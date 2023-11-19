<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $file;

    /**
     * Create a new message instance.
     *
     * @param  array  $data
     * @param  array  $file
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->file = [
            'file_path' => public_path('forms/preapproval-mfs.docx'), // use public_path() to get the correct absolute path
            'file_name' => 'Pre-Approval-Form.docx',
            'file_mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            // other data for the email template
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.loan-email')
            ->attach($this->file['file_path'], [
                'as' => $this->file['file_name'],
                'mime' => $this->file['file_mime'],
            ]);
    }
}
