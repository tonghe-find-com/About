<?php

namespace TypiCMS\Modules\Abouts\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Abouts\Composers\SidebarViewComposer;
use TypiCMS\Modules\Abouts\Facades\Abouts;
use TypiCMS\Modules\Abouts\Models\About;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.abouts');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['abouts' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'abouts');

        $this->publishes([
            __DIR__.'/../database/migrations/create_abouts_table.php.stub' => getMigrationFileName('create_abouts_table'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/abouts'),
        ], 'views');

        AliasLoader::getInstance()->alias('Abouts', Abouts::class);

        // Observers
        About::observe(new SlugObserver());

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('abouts::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('abouts');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Abouts', About::class);
    }
}
