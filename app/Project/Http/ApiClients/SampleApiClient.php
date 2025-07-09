<?php

namespace App\Project\Http\ApiClients;

use Cache;
use App\Mainframe\Features\ApiClient\ApiClient;

class SampleApiClient extends ApiClient
{
    public function __construct()
    {
        parent::__construct();

        $this->clientId = project_config('foreign_application_system.api.client_id');
        $this->xAuthToken = project_config('foreign_application_system.api.x_auth_token');
        $this->baseUrl = project_config('foreign_application_system.api.base_url');

    }

    /**
     * Get a list of applications
     *
     * @param  array  $params
     * @return array|object
     */
    public static function getApplicationList($params = [])
    {
        return (new self())
            ->client() // Laravel HTTP client
            ->get('foreign-student-applications', $params)
            ->object(); // or ->json()
    }

    /**
     * Get a single application object
     *
     * @param $id
     * @return array|object|void
     */
    public static function getApplication($id)
    {
        if (!$id) {
            return null;
        }

        # For performance optimization cache the response for future use. The application is less likely to change (may be?).
        $response = Cache::remember('foreign-application-'.$id, timer('none'), function () use ($id) {
            return (new self())
                ->client()
                ->get('foreign-student-applications/'.$id)
                ->object();
        });

        if ($response->status == 'success') {
            return $response->data;
        }

        return null;
    }

}
