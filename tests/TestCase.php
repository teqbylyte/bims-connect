<?php

namespace Teqbylyte\BimsConnect\Tests;
use Teqbylyte\BimsConnect\BimsConnectServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function getPackageProviders($app): array
    {
        return [
            BimsConnectServiceProvider::class
        ];
    }
}
