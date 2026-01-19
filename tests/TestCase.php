<?php

namespace Juzaweb\Modules\Contact\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Juzaweb\Modules\Contact\Providers\ContactServiceProvider;
use Juzaweb\Modules\Core\Providers\CoreServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
            ContactServiceProvider::class,
        ];
    }
}
