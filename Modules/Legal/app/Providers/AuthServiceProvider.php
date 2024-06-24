<?php

namespace Modules\Legal\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Policies\CourtAppearancePolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        CourtAppearance::class => CourtAppearancePolicy::class,
    ];

    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super_admin')) {
                return true;
            }

            return false;
        });
    }

}
