<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $account;

    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@amigarut.ac.id', 'Admin AMIK Garut')
                    ->subject('Akun Absensi AMIK Garut')
                    ->view('email.sendaccount')
                    ->with([
                        'name' => $this->account['name'],
                        'email' => $this->account['email'],
                        'nim' => $this->account['nim'],
                        'password' => $this->account['password'],
                        'flash' => $this->account['flash']
                    ]);
    }
}
