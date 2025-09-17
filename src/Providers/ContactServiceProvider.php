<?php

namespace Juzaweb\Modules\Contact\Providers;

use Juzaweb\Core\Facades\Menu;
use Juzaweb\Core\Providers\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //

        $this->booted(
            function () {
                $this->registerMenus();
            }
        );
    }

    public function register(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->app->register(RouteServiceProvider::class);
    }

    protected function registerMenus(): void
    {
        Menu::make('contact', __('Contact'))->icon('fas fa-envelope');


    }

    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/contact.php' => config_path('contact.php'),
        ], 'contact-config');
        $this->mergeConfigFrom(__DIR__ . '/../../config/contact.php', 'contact');
    }

    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'contact');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
    }

    protected function registerViews(): void
    {
        $viewPath = resource_path('views/modules/contact');

        $sourcePath = __DIR__ . '/../src/resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'contact-module-views']);

        $this->loadViewsFrom($sourcePath, 'contact');
    }
}
