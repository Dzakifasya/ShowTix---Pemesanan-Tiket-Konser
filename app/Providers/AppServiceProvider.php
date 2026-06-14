<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\KonserRepositoryInterface;
use App\Repositories\KonserRepository;
use App\Repositories\KategoriTiketRepositoryInterface;
use App\Repositories\KategoriTiketRepository;
use App\Repositories\PembeliRepositoryInterface;
use App\Repositories\PembeliRepository;
use App\Repositories\PemesananRepositoryInterface;
use App\Repositories\PemesananRepository;
use App\Repositories\TransaksiRepositoryInterface;
use App\Repositories\TransaksiRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(KonserRepositoryInterface::class, KonserRepository::class);
        $this->app->bind(KategoriTiketRepositoryInterface::class, KategoriTiketRepository::class);
        $this->app->bind(PembeliRepositoryInterface::class, PembeliRepository::class);
        $this->app->bind(PemesananRepositoryInterface::class, PemesananRepository::class);
        $this->app->bind(TransaksiRepositoryInterface::class, TransaksiRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

