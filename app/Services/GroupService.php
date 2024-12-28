<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public function create(array $data): Group
    {
        return Group::create($data);
    }

    public function update(Group $group, array $data): Group
    {
        $group->update($data);
        return $group;
    }

    public function getGroupWithUsers(int $id): Group
    {
        return Group::with('users')->findOrFail($id);
    }
}
