<?php

namespace Teqbylyte\BimsConnect\Tests\Feature;

use Illuminate\Http\RedirectResponse;
use Mockery;
use Laravel\Socialite\Facades\Socialite;
use Teqbylyte\BimsConnect\BimsConnect;
use Teqbylyte\BimsConnect\Tests\TestCase;

class BimsConnectTest extends TestCase
{
    /**
     * Test that Bims driver returns the correct redirect URL.
     *
     * @return void
     */
    public function test_bims_driver_returns_expected_redirect_url()
    {
        $url = 'https://bims.example.com/oauth/authorize';
        // Mock the Socialite::driver method to return a mock Bims driver
        $mockBimsDriver = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $mockBimsDriver->shouldReceive('redirect')->andReturn(new RedirectResponse($url));

        // Replace the Bims driver with the mock driver
        Socialite::shouldReceive('driver')->with('bims')->andReturn($mockBimsDriver);

        // Call the BimsConnect package to get the redirect URL
        $redirectUrl = BimsConnect::init()->redirect()->getTargetUrl();

        // Assert that the redirect URL matches the expected URL
        $this->assertEquals($url, $redirectUrl);
    }

    // Remember to clean up the mocks after each test
    public function tearDown(): void
    {
        Mockery::close();
    }
}
