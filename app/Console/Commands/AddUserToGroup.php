<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Group;
use App\Services\UserService;

class AddUserToGroup extends Command
{
    protected $signature = 'user:member';
    protected $description = 'Добавление пользователя в группу и активация, если он не активен';

    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function handle()
    {
        $userId = $this->ask('Введите user_id');
        $groupId = $this->ask('Введите group_id');

        $user = User::find($userId);
        $group = Group::find($groupId);

        if (!$user || !$group) {
            $this->error('Пользователь или группа не найдены!');
            return;
        }

        if (!$user->active) {
            $this->info('Пользователь не активен. Активируем его.');
            $user->active = true;
            $user->save();
        }

        $this->userService->addUserToGroup($user, $group);
        $this->info("Пользователь добавлен в группу.");
    }
}
