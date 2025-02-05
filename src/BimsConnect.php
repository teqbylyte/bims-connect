<?php

namespace Teqbylyte\BimsConnect;

use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite;

class BimsConnect
{
    /**
     * Get the bims socialite driver instance.
     *
     * @return Provider
     */
    public static function init(): Provider
    {
        return Socialite::driver('bims');
    }

    public static function logoutUrl(string $bims_id, string $redirect_url): string
    {
        $client_id  = config('services.bims.client_id');

        return sprintf("https://account.bims.ng/clients/%s/users/%s/logout?redirect_to=%s",
            $client_id,
            $bims_id,
            $redirect_url
        );
    }
}