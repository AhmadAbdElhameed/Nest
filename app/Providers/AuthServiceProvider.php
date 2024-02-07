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

//        Gate::define('users', function (Admin $admin) {
//            return in_array('users', $admin->role->permissions);
//        });

        $permissions = config('global.permissions');

        foreach ($permissions as $permission) {
            Gate::define($permission, function (Admin $admin) use ($permission) {
                return in_array($permission, $admin->role->permissions ?? []);
            });
        }


    }
}
