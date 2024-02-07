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

//        Gate::define('brands', function (Admin $admin) {
//            return in_array('brands', $admin->role->permissions);
//        });

        $permissions = config('global.permissions');
//        $permissions = ['brands', 'categories', 'tags', 'options', 'products', 'users'];

//        foreach ($permissions as $permission ) {
//            Gate::define($permission, function (Admin $admin) use ($permission) {
//                return in_array($permission, $admin->role->permissions ?? []);
//            });
//        }

        foreach ($permissions as $key => $description) {
            Gate::define($key, function (Admin $admin) use ($key) {
                // Assuming $admin->role->permissions is an array of keys ['products', 'tags', ...]
                return in_array($key, $admin->role->permissions ?? []);
            });
        }


    }
}
