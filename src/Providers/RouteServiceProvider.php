<?php

namespace TypiCMS\Modules\Abouts\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Abouts\Http\Controllers\AdminController;
use TypiCMS\Modules\Abouts\Http\Controllers\ApiController;
use TypiCMS\Modules\Abouts\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('abouts')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-abouts');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('about');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('abouts', [AdminController::class, 'index'])->name('index-abouts')->middleware('can:read abouts');
            $router->get('abouts/export', [AdminController::class, 'export'])->name('admin::export-abouts')->middleware('can:read abouts');
            $router->get('abouts/create', [AdminController::class, 'create'])->name('create-about')->middleware('can:create abouts');
            $router->get('abouts/{about}/edit', [AdminController::class, 'edit'])->name('edit-about')->middleware('can:read abouts');
            $router->post('abouts', [AdminController::class, 'store'])->name('store-about')->middleware('can:create abouts');
            $router->put('abouts/{about}', [AdminController::class, 'update'])->name('update-about')->middleware('can:update abouts');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('abouts', [ApiController::class, 'index'])->middleware('can:read abouts');
            $router->patch('abouts/{about}', [ApiController::class, 'updatePartial'])->middleware('can:update abouts');
            $router->delete('abouts/{about}', [ApiController::class, 'destroy'])->middleware('can:delete abouts');
        });
    }
}
