<?php

namespace App\Providers;
use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Interfaces\Admin\AttributeInterface;
use App\Http\Interfaces\Admin\BrandInterface;
use App\Http\Interfaces\Admin\CategoryInterface;
use App\Http\Interfaces\Admin\LoginInterface;
use App\Http\Interfaces\Admin\OptionInterface;
use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Interfaces\Admin\SliderInterface;
use App\Http\Interfaces\Admin\SubCategoryInterface;
use App\Http\Interfaces\Admin\TagInterface;
use App\Http\Interfaces\Front\HomeInterface;
use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Repositories\Admin\AttributeRepository;
use App\Http\Repositories\Admin\BrandRepository;
use App\Http\Repositories\Admin\CategoryRepository;
use App\Http\Repositories\Admin\LoginRepository;
use App\Http\Repositories\Admin\OptionRepository;
use App\Http\Repositories\Admin\ProductRepository;
use App\Http\Repositories\Admin\SliderRepository;
use App\Http\Repositories\Admin\SubCategoryRepository;
use App\Http\Repositories\Admin\TagRepository;
use App\Http\Repositories\Front\HomeRepository;
use Illuminate\Support\ServiceProvider;


use App\Http\Interfaces\Admin\SettingInterface;
use App\Http\Repositories\Admin\SettingRepository;
use App\Http\Interfaces\Admin\ProfileInterface;
use App\Http\Repositories\Admin\ProfileRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        ########## Admin ###########
        $this->app->bind(SettingInterface::class, SettingRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(LoginInterface::class, LoginRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(BrandInterface::class, BrandRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(AttributeInterface::class, AttributeRepository::class);
        $this->app->bind(OptionInterface::class, OptionRepository::class);
        $this->app->bind(SliderInterface::class, SliderRepository::class);


        ########## Admin ###########
        $this->app->bind(HomeInterface::class, HomeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
