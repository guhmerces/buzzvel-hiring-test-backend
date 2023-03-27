<?php

namespace App\Providers;

use App\Helpers\QRCodeHelper;
use Illuminate\Support\ServiceProvider;
use chillerlan\QRCode\{
    QRCode,
    QROptions
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(QRCodeHelper::class, function ($app) {
            return new QRCodeHelper([
                'version' => 5,
                'output' => QRCode::OUTPUT_IMAGE_PNG,
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
