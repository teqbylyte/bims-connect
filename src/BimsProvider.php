<?php

namespace Teqbylyte\BimsConnect;

use Illuminate\Support\Arr;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;

class BimsProvider extends AbstractProvider
{
    const BASE_URL = 'https://bims.tetfund.gov.ng';

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * @inheritDoc
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(self::BASE_URL . '/oauth/authorize', $state);
    }

    /**
     * @inheritDoc
     */
    protected function getTokenUrl(): string
    {
        return self::BASE_URL . '/oauth/token';
    }

    public function user(): User|BimsUser|null
    {
        if ($this->user) {
            return $this->user;
        }

        if ($this->hasInvalidState()) {
            throw new InvalidStateException;
        }

        $response = $this->getAccessTokenResponse($this->getCode());

        $user = Arr::get($response, 'user');

        return $this->userInstance($response, $user);
    }

    /**
     * @inheritDoc
     */
    protected function getUserByToken($token)
    {
        // Todo: Implement
    }

    /**
     * @inheritDoc
     */
    protected function mapUserToObject(array $user): BimsUser
    {
        $user = (new BimsUser)->setRaw($user)->map([
            'id'                => $user['bims_id'],
            'first_name'        => $user['first_name'],
            'middle_name'       => $user['middle_name'],
            'last_name'         => $user['last_name'],
            'email'             => $user['email'],
            'avatar'            => $user['photo'],
            'avatar_original'   => $user['photo'],
            'phone'             => $user['phone'],
            'type'              => $user['type'],
            'unique_id'         => $user['unique_id'],
            'institution_id'    => $user['institution_id'],
            'institution'       => (object) $user['institution'],
        ]);

        $name = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;

        $user->name = str($name)->replace('  ', ' ')->value();

        return $user;
    }
}