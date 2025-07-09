<?php

namespace App\Mainframe\Helpers\Test;

use App\User;
use App\Mainframe\Features\Modular\BaseModule\BaseModule;

trait TestHelperTrait
{
    /**
     * Get the latest user
     *
     * @return \App\User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function latestUser()
    {
        return User::latest()->first();
    }

    /**
     * Get last updated user
     *
     * @return \Illuminate\Database\Eloquent\Model|object
     */
    public function lastUpdatedUser()
    {
        return User::orderBy('updated_at', 'DESC')->first();
    }

    /**
     * Get the 'errors'=>... from a response
     *
     * @param $response
     * @return mixed|null
     * @throws \JsonException
     */
    public function errors($response)
    {
        return $this->getErrorsFromResponse($response);
    }

    /**
     * Get errors from response
     *
     * @param $response
     * @return array|mixed
     * @depricated Use errors()
     * @throws \JsonException
     */
    public function getErrorsFromResponse($response)
    {
        return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)['errors'] ?? [];
    }

    /**
     * Get the 'date'=>... from a response
     *
     * @param $response
     * @return mixed|null
     */
    public function payload($response)
    {
        return $this->getPayloadFromResponse($response);
    }

    /**
     * Get the data from response
     *
     * @param $response
     * @return mixed|null
     * @depricated use payload()
     */
    public function getPayloadFromResponse($response)
    {
        return json_decode($response->getContent(), true)['data'] ?? null;
    }

    /**
     * Get auth_token of latest user
     *
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string|null
     */
    public function getBearerToken()
    {
        return $this->latestUser()->auth_token;
    }

    /**
     * Get last created model
     *
     * @param  null  $class
     * @param  bool  $print
     * @return \App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public function latest($class = null, $print = true)
    {
        if (!$class && isset($this->module)) {
            $class = $this->module->modelInstance();
        }

        /** @var BaseModule $latest */
        $latest = $class::latest()->first();
        if ($print) {
            $this->printFetched($latest);
        }
        return $latest;
    }

    /**
     * Get last updated model
     *
     * @param  $class
     * @return \App\Mainframe\Features\Modular\BaseModule\BaseModule|null
     */
    public function lastUpdate($class)
    {
        return $class::orderBy('updated_at', 'DESC')->first();
    }

    /**
     * Update the last item name with TEST-- prefix
     *
     * @param $response
     * @return $this
     */
    public function markAsTest($response)
    {
        $payload = $this->payload($response);
        if (isset($payload['id'])) {
            $this->module->modelInstance()->find($payload['id'])
                ->update(['name' => 'TEST-- '.now()]);
        }
        return $this;
    }

    /**
     * Print comment during test to help better understand the scenario on test run
     *
     * @param  null  $str
     * @param  null  $value
     * @return void
     */
    public function print($str = null, $value = null)
    {
        // 📥 🧰 🟥 🟩

        if ($str) {
            fwrite(STDOUT, $str."\n");
        }

        if (is_array($value)) {
            fwrite(STDOUT, print_r($value, true));
        } elseif (isJson($value)) {
            fwrite(STDOUT, json_encode(json_decode($value), JSON_PRETTY_PRINT));
        } else {
            fwrite(STDOUT, $value);
        }
        fwrite(STDOUT, "\n\n");
        // fwrite(STDOUT, "----------------------------------------------------- \n\n");
    }

    /**
     * Print fetched data
     *
     * @param $data
     * @return void
     */
    public function printFetched($data)
    {
        $this->print(self::MSG_FETCHED_FROM_DB, get_class($data));
        $this->print('', $data->toArray());
    }

    /**
     * Print string with new line.
     *
     * @param  string  $str
     * @param  null  $value
     * @return void
     */
    public function printLn($str = '', $value = null)
    {
        // 📥 🧰 🟥 🟩
        fwrite(STDOUT, "----------------------------------------------------- \n");
        $this->print($str, $value);
    }

    /**
     * Print comparison
     *
     * @param $got
     * @param $expected
     * @return void
     */
    public function printCompare($got = null, $expected = null, $msg = null)
    {
        sort($got);
        sort($expected);
        $this->print($msg, json_encode(['got' => $got, 'Expected' => $expected]));
    }
}
