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
            \Juzaweb\Hooks\HooksServiceProvider::class,
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
    }
}
