<?php

namespace App\Providers;

use App\Interfaces\CartInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ContactUsInterface;
use App\Interfaces\FavoriteInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\RateInterface;
use App\Interfaces\UserInterface;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ContactUsRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RateRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
