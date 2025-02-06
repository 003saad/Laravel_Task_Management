<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use App\Policies\TaskPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }

    protected function registerPolicies()
    {
        Gate::policy(Task::class, TaskPolicy::class);
    }
}