<?php

namespace App\Mainframe\Helpers\Test;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;

abstract class ApiTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->setApiToken();
        // $this->setBearerToken();
    }

    /**
     * Set api token
     *
     * @param  null  $token
     * @param  null  $clientId
     * @return $this
     */
    public function setApiToken($token = null, $clientId = null)
    {
        $token = $token ?: $this->getXAuthToken();
        $clientId = $clientId ?: $this->apiUser()->id;
        $this->withHeaders([
            'X-Auth-Token' => $token,
            'client-id' => $clientId,
        ]);

        return $this;
    }

    /**
     * Set logged in users auth/bearer token.
     *
     * @param  null  $authToken
     * @return $this
     */
    public function setBearerToken($authToken)
    {

        $this->withHeaders([
            'Authorization' => 'Bearer '.$authToken,
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function setBearer(User|Authenticatable $user)
    {
        if ($user->auth_token == null) {
            abort(403, 'auth_token not found for user:'.$user->id);
        }

        $this->setBearerToken($user->auth_token);

        return $this;
    }

    /**
     * Get API user
     *
     * @return object|User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function apiUser()
    {

        return User::find(config('test.api_user_id'));
    }

    /**
     * Get API X-Auth-Token
     *
     * @return mixed
     */
    public function getXAuthToken()
    {
        return $this->apiUser()->api_token;
    }
}
