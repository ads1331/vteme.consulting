<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\GroupService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;

class UserController extends Controller
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
            'email' => 'required|email|unique:users,email',
        ]);
        $user = $this->userService->create($data);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
    $data = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
        'active' => 'sometimes|boolean',
    ]);

    $user = $this->userService->update($user, $data);

    return response()->json($user);
    }


    public function show($id)
    {
        $user = $this->userService->getUserWithGroups($id);

        return response()->json($user);
    }

    public function addToGroup(Request $request, User $user)
    {
        $data = $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);
        $group = Group::findOrFail($data['group_id']);

        try {
            $user = $this->userService->addUserToGroup($user, $group);
            return response()->json($user->load('groups'), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function removeFromGroup(Request $request, User $user)
    {
        $data = $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);
        $group = Group::findOrFail($data['group_id']);

        try {
            $user = $this->userService->removeUserFromGroup($user, $group);
            return response()->json(['message' => 'User removed from group successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
