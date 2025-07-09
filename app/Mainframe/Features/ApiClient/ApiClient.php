<?php

namespace App\Mainframe\Features\ApiClient;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    public $header;
    public $clientId;
    public $xAuthToken;
    public $baseUrl;

    public function __construct()
    {
        // parent::__construct();

        $this->clientId = $this->clientId ?: config('services.systemX.client_id');
        $this->xAuthToken = $this->xAuthToken ?: config('services.systemX.x_auth_token');
        $this->baseUrl = $this->baseUrl ?: config('services.systemX.base_url');

        $this->header = [
            'client-id' => $this->clientId,
            'X-Auth-Token' => $this->xAuthToken,
        ];
    }

    /**
     * @return \Illuminate\Http\Client\PendingRequest
     */
    public function client()
    {
        return Http::withHeaders($this->header())
            ->baseUrl($this->baseUrl());
    }

    /**
     * Header for API call
     *
     * @return array
     */
    public function header()
    {
        return [
            'client-id' => $this->clientId,
            'X-Auth-Token' => $this->xAuthToken,
        ];
    }

    /**
     * Base URL for api calls
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function baseUrl()
    {
        return $this->baseUrl;
    }
}
