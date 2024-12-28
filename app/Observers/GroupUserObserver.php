<?php

namespace App\Observers;

use App\Models\GroupUser;
use Illuminate\Support\Carbon;

class GroupUserObserver
{
    public function saved(GroupUser $groupUser)
    {
        $group = $groupUser->group;
        $groupUser->expired_at = Carbon::now()->addHours($group->expire_hours);
        $groupUser->save();
    }
}

