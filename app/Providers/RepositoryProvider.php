<?php

namespace App\Providers;

use App\Interfaces\CartInterface;
use App\Interfaces\RateInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\AdminInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;
use App\Repositories\CartRepository;
use App\Repositories\RateRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Interfaces\CategoryInterface;
use App\Interfaces\FavoriteInterface;
use App\Repositories\AdminRepository;
use App\Repositories\OrderRepository;
use App\Interfaces\ContactUsInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\ContactUsRepository;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(FavoriteInterface::class, FavoriteRepository::class);
        $this->app->bind(CartInterface::class, CartRepository::class);
        $this->app->bind(RateInterface::class, RateRepository::class);
        $this->app->bind(ContactUsInterface::class, ContactUsRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
