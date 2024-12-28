<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\GroupService;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    protected UserService $userService;
    protected GroupService $groupService;

    public function __construct(UserService $userService, GroupService $groupService)
    {
        $this->userService = $userService;
        $this->groupService = $groupService;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'expire_hours' => 'required|integer|min:1',
        ]);
        $group = $this->groupService->create($data);

        return response()->json($group, 201);
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'expire_hours' => 'sometimes|required|integer|min:1',
        ]);
        $group = $this->groupService->update($group, $data);

        return response()->json($group);
    }

    public function show($id)
    {
        $group = $this->groupService->getGroupWithUsers($id);

        return response()->json($group);
    }

    public function index()
    {
        $groups = Group::all();

        return response()->json($groups);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json(['message' => 'Group deleted successfully.'], 200);
    }
    public function addUserToGroup(Request $request, Group $group, User $user)
    {
        if ($group->users->contains($user->id)) {
            return response()->json(['message' => 'User is already in the group.'], 400);
        }

        try {
            $this->userService->addUserToGroup($user, $group);

            return response()->json(['message' => 'User added to group successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add user to group. ' . $e->getMessage()], 400);
        }
    }
}
