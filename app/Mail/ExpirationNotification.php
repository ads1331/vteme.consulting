<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;
use App\Models\Group;

class ExpirationNotification extends Mailable
{
    public $user;
    public $group;

    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
    }

    public function build()
    {
        return $this->subject('Истекло время вашего участия в группе')
                    ->view('emails.notification');
    }
}
