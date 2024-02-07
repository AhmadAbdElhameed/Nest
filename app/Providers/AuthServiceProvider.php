<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define a gate for 'manage brands' ability
        Gate::define('brands', function (Admin $admin) {
            return in_array('brands', $admin->role->permissions);
        });
        Gate::define('categories', function (Admin $admin) {
            return in_array('categories', $admin->role->permissions);
        });

        Gate::define('tags', function (Admin $admin) {
            return in_array('tags', $admin->role->permissions);
        });

        Gate::define('options', function (Admin $admin) {
            return in_array('options', $admin->role->permissions);
        });

        Gate::define('products', function (Admin $admin) {
            return in_array('products', $admin->role->permissions);
        });

        Gate::define('users', function (Admin $admin) {
            return in_array('users', $admin->role->permissions);
        });
    }
}
