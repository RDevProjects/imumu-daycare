<?php

namespace App\Providers;

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
        // ponytail: single-role admin gate. Expand to Policies if more roles appear.
        Gate::before(fn ($user) => $user->role === 'admin');
    }
}
