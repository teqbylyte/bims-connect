<?php

namespace Teqbylyte\BimsConnect;

use Laravel\Socialite\Facades\Socialite;

class BimsConnect
{
    /**
     * Get the bims socialite driver instance.
     *
     * @return \Laravel\Socialite\Contracts\Provider|mixed
     */
    public static function init(): mixed
    {
        return Socialite::driver('bims');
    }
}