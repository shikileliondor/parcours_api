<?php

namespace App\Providers;

use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Ecole;
use App\Policies\EcolePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Ecole::class, EcolePolicy::class);
        app('router')->aliasMiddleware('admin', EnsureUserIsAdmin::class);
    }
}
