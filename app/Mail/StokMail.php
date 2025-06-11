<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StokMail extends Mailable
{
    use Queueable, SerializesModels;

    public $alert;
    public $ids;

    public function __construct($alert)
    {
        $this->alert = $alert;
        $this->ids = $alert->pluck('id')->toArray(); // ID listesi çıkar
    }

    public function build()
    {
        return $this->subject('Haftalık Toplu Sipariş Listesi')
            ->view('emails.stok_mail', [
                'ids' => implode(',', $this->ids),
                'date' => now()->format('d.m.Y')
            ]);
    }
}
