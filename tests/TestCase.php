<?php

namespace Lemaur\LaravelTypedConfig\Tests;

use Lemaur\LaravelTypedConfig\LaravelTypedConfigServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelTypedConfigServiceProvider::class,
        ];
    }
}
