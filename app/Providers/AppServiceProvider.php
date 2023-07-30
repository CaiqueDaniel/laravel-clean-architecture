<?php

namespace App\Providers;

use App\Core\Modules\Category\Domain\Repositories\CategoryRepository;
use App\Core\Modules\Category\Infrastructure\Repositories\CategoryRepositoryEloquent;
use App\Core\Modules\Post\Domain\Repositories\PostRepository;
use App\Core\Modules\Post\Infrastructure\Repositories\PostRepositoryEloquent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $repositories = [
            [PostRepository::class, PostRepositoryEloquent::class],
            [CategoryRepository::class, CategoryRepositoryEloquent::class]
        ];

        foreach ($repositories as $repository)
            App::bind($repository[0], $repository[1]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
