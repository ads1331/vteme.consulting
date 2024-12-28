<?php

namespace App\Providers;

use App\Models\GroupUser;
use App\Observers\GroupUserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        GroupUser::observe(GroupUserObserver::class);
    }
}
