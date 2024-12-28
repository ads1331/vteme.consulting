<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GroupUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpirationNotification;

class CheckUserExpiration extends Command
{
    protected $signature = 'user:check_expiration';
    protected $description = 'Проверка истечения срока участия пользователей в группах';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
    $expiredGroupUsers = GroupUser::where('expired_at', '<', now())->get();

    foreach ($expiredGroupUsers as $groupUser) {
        $user = $groupUser->user;
        $group = $groupUser->group;

        if (!$user || !$group) {
            continue;
        }

        $groupUser->delete();

        Mail::to($user->email)->send(new ExpirationNotification($user, $group));

        if ($user->groups()->count() === 0) {
            $user->active = false;
            $user->save();
        }
    }
}


}