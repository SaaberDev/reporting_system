<?php

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInvited extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Invite
     */
    public $invite;
    public $pass;

    /**
     * Create a new message instance.
     *
     * @param Invite $invite
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@demo.com')
            ->view('emails.invite');
    }
}
