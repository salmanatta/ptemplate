<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            $classDirname = str_replace(
                ['/', '\Models'],
                ['\\', '\Policies'],
                dirname(str_replace('\\', '/', $modelClass))
            );

            if (! str_contains($classDirname, '\Policies')) {
                $classDirname .= '\Policies';
            }

            $policyClass = $classDirname.'\\'.class_basename($modelClass).'Policy';

            if (class_exists($policyClass)) {
                return $policyClass;
            }

            return Policy::class;
        });

        $this->registerPolicies();
    }
}
