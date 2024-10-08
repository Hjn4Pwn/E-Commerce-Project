<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Router;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Services\Interfaces\LocationServiceInterface' => 'App\Services\LocationService',
        'App\Services\Interfaces\CategoryServiceInterface' => 'App\Services\CategoryService',
        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',
        'App\Services\Interfaces\ImageServiceInterface' => 'App\Services\ImageService',
        'App\Services\Interfaces\FlavorServiceInterface' => 'App\Services\FlavorService',
        'App\Services\Interfaces\CartServiceInterface' => 'App\Services\CartService',
        'App\Services\Interfaces\OrderServiceInterface' => 'App\Services\OrderService',
        'App\Services\Interfaces\AdminServiceInterface' => 'App\Services\AdminService',
        'App\Services\Interfaces\ReviewServiceInterface' => 'App\Services\ReviewService',
        'App\Services\Interfaces\SliderServiceInterface' => 'App\Services\SliderService',
        'App\Services\Interfaces\VerificationServiceInterface' => 'App\Services\VerificationService',
        'App\Services\Interfaces\DashboardServiceInterface' => 'App\Services\DashboardService',
        'App\Services\Interfaces\ElasticsearchServiceInterface' => 'App\Services\ElasticsearchService',

    ];

    public function register(): void
    {
        foreach ($this->serviceBindings as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {
        Paginator::useBootstrapFour();
        $router->bind('productSlug', function ($value) {
            return Product::where('slug', $value)->firstOrFail();
        });
    }
}
