<?php

namespace Teqbylyte\BimsConnect;

use Illuminate\Http\RedirectResponse;
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

    /**
     * Get the redirect url for user logout from bims account.
     *
     * @param string $bimsId - The BIMS ID for the user to be logged out
     * @param string|null $redirectTo - Your page to redirect to after logout
     * @return string
     */
    public static function logoutUrl(string $bimsId, string $redirectTo = null): string
    {
        $redirectTo ??= config('app.url');
        $clientId = config('services.bims.client_id');

        $url = BimsProvider::ACCOUNT_BASE_URL . '/clients/' . $clientId . '/users/' . $bimsId;

        return str($url)
            ->append("/logout?redirect_to=$redirectTo")
            ->value();
    }

    /**
     * Log the user out from the bims account and redirecting to your page after the logout.
     *
     * @param string $bimsId - The BIMS ID for the user to be logged out
     * @param string|null $redirectTo - Your page to redirect to after logout
     * @return RedirectResponse
     */
    public static function logout(string $bimsId, string $redirectTo = null): RedirectResponse
    {
        return new RedirectResponse(self::logoutUrl($bimsId, $redirectTo));
    }
}