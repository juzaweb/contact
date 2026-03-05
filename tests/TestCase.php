<?php

namespace Juzaweb\Modules\Contact\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Juzaweb\Modules\Contact\Providers\ContactServiceProvider;
use Juzaweb\Modules\Core\Providers\CoreServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
            ContactServiceProvider::class,
            \Juzaweb\QueryCache\QueryCacheServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Theme' => \Juzaweb\Modules\Core\Facades\Theme::class,
            'Hook' => \Juzaweb\Modules\Core\Facades\Hook::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('translatable.fallback_locale', 'en');

        $app->bind(\Juzaweb\Hooks\Contracts\Hook::class, function () {
            return new class implements \Juzaweb\Hooks\Contracts\Hook {
                public function addAction(string $hook, $callback, int $priority = 20, int $arguments = 1) {}
                public function removeAction(string $hook, $callback, int $priority = 20) {}
                public function removeAllActions(?string $hook = null): void {}
                public function addFilter(string $hook, $callback, int $priority = 20, int $arguments = 1) {}
                public function removeFilter(string $hook, $callback, int $priority = 20) {}
                public function removeAllFilters(?string $hook = null) {}
                public function filter(): mixed { return func_get_arg(0) ?? null; }
                public function action(): void {}
                public function getAction() {}
                public function getFilter() {}
                public function allAction(): array { return []; }
            };
        });
    }
}
