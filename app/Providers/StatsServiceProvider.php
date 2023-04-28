<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Project;
use App\Models\Service;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Support\Facades\View;

class StatsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::share('projectsCount', Project::count());
        View::share('servicesCount', Service::count());
        View::share('newsCount', News::count());
        View::share('tagsCount', Tag::count());
    }
}
