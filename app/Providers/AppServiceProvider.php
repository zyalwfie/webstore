<?php

namespace App\Providers;

use App\Actions\ValidateCartStock;
use App\Models\User;
use Illuminate\Support\Number;
use App\Service\SessionCartService;
use Illuminate\Support\Facades\Gate;
use App\Contract\CartServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, SessionCartService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Number::useCurrency('IDR');

        Gate::define('is_stock_available', function(User $user = null) {
            try {
                ValidateCartStock::run();
                return true;
            } catch (ValidationException $error) {
                session()->flash('error', $error->getMessage());
                return false;
            }
        });
    }
}
