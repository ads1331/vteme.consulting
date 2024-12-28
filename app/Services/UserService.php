<?php

namespace App\Services;

use App\Models\User;
use App\Models\Group;

class UserService
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function getUserWithGroups(int $id): User
    {
        return User::with('groups')->findOrFail($id);
    }

    public function addUserToGroup(User $user, Group $group): User
    {
        if ($user->groups()->where('group_id', $group->id)->exists()) {
            throw new \Exception("User is already in this group");
        }
        $expireAt = now()->addHours($group->expire_hours);
        $user->groups()->attach($group->id, ['expired_at' => $expireAt]);

        return $user;
    }

    public function removeUserFromGroup(User $user, Group $group): User
    {
        if (!$user->groups()->where('group_id', $group->id)->exists()) {
            throw new \Exception("User is not in this group");
        }
        $user->groups()->detach($group->id);

        return $user;
    }
}
