<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tieu_de;
    public $noi_dung;

    /**
     * Create a new message instance.
     */
    public function __construct($tieu_de, $noi_dung)
    {
        $this->tieu_de = $tieu_de;
        $this->noi_dung = $noi_dung;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->tieu_de)
                    ->view('emails.admin_notification')
                    ->with([
                        'tieu_de' => $this->tieu_de,
                        'noi_dung' => $this->noi_dung,
                    ]);
    }
}
