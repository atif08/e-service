<?php

namespace App\Mail;

use App\Models\CertifiedUserApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Support\Media\Enums\MediaCollectionEnum;

class CertifiedUserApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public CertifiedUserApplication $data;
    public string $path;

    public function __construct($data,$path)
    {
        $this->data = $data;
        $this->path = $path;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Thanks to submit the request')
            ->view('emails.certified_user_approved_email')->attach($this->path, [
            'as' => 'name.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
