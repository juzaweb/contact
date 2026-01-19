<?php

namespace Juzaweb\Modules\Contact\Providers;

use Juzaweb\Modules\Core\Facades\Menu;
use Juzaweb\Modules\Core\Providers\ServiceProvider;

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
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->app->register(RouteServiceProvider::class);
    }

    protected function registerMenus(): void
    {
        //Menu::make('contact', function () {
        //    return [
        //        'title' => __('contact::translation.contact'),
        //        'icon' => 'fas fa-envelope',
        //    ];
        //});

        Menu::make('contacts', function () {
            return [
                'title' => __('contact::translation.contacts'),
                'icon' => 'fas fa-envelope',
                'permissions' => 'contacts.index',
            ];
        });
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/contact.php' => config_path('contact.php'),
        ], 'contact-config');
        $this->mergeConfigFrom(__DIR__ . '/../config/contact.php', 'contact');
    }

    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'contact');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
    }

    protected function registerViews(): void
    {
        $viewPath = resource_path('views/modules/contact');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'contact-module-views']);

        $this->loadViewsFrom($sourcePath, 'contact');
    }
}
