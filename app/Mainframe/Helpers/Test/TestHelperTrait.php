<?php

namespace App\Mainframe\Helpers\Test;

use App\Mainframe\Features\Modular\BaseModule\BaseModule;
use Log;

trait TestHelperTrait
{
    /**
     * Get the 'errors'=>... from a response
     *
     * @return mixed|null
     *
     * @throws \JsonException
     */
    public function errors($response)
    {
        return $this->getErrorsFromResponse($response);
    }

    /**
     * Get errors from response
     *
     * @return array|mixed
     *
     * @depricated Use errors()
     *
     * @throws \JsonException
     */
    public function getErrorsFromResponse($response)
    {
        return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)['errors'] ?? [];
    }

    /**
     * Get the 'date'=>... from a response
     *
     * @return mixed|null
     */
    public function payload($response)
    {
        return $this->getPayloadFromResponse($response);
    }

    /**
     * Get the data from response
     *
     * @return mixed|null
     *
     * @depricated use payload()
     */
    public function getPayloadFromResponse($response)
    {
        return json_decode($response->getContent(), true)['data'] ?? null;
    }

    /**
     * Get last created model
     *
     * @param  null  $class
     * @param  bool  $print
     * @return \App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public function latest($class = null, $print = false)
    {
        if (! $class && isset($this->module)) {
            $class = $this->module->modelInstance();
        }

        /** @var BaseModule $latest */
        $latest = $class::latest('id')->first();
        if ($print) {
            $this->printFetched($latest);
        }

        return $latest;
    }

    /**
     * Get last updated model
     *
     * @return \App\Mainframe\Features\Modular\BaseModule\BaseModule|null
     */
    public function lastUpdate($class)
    {
        return $class::orderBy('updated_at', 'DESC')->first();
    }

    /**
     * Print comment during test to help better understand the scenario on test run
     *
     * @param  mixed|null  $value
     * @return void
     */
    public function print(?string $msg = null, $value = null)
    {

        // 📥 🧰 🟥 🟩
        if ($msg) {
            fwrite(STDOUT, $msg."\n");
        }

        if ($value) {
            fwrite(STDOUT, $this->convertToJson($value)."\n");
        }
        // fwrite(STDOUT, "--------------------------------\n");
    }

    /**
     * Convert a value to json string
     *
     * @param  mixed  $input
     */
    public function convertToJson($input): string
    {
        if (is_array($input) || is_object($input)) {
            return json_encode($input, JSON_PRETTY_PRINT);
        } elseif (isJson($input)) {
            return json_encode(json_decode($input), JSON_PRETTY_PRINT);
        }

        return (string) $input;
    }

    /**
     * Print fetched data
     *
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
     * @param  string  $msg
     * @param  null  $value
     * @return void
     */
    public function printLn($msg = '', $value = null)
    {
        // 📥 🧰 🟥 🟩
        // fwrite(STDOUT, "--------------------------------\n");
        $this->print($msg, $this->convertToJson($value));
    }

    /**
     * Print in console and write in log
     *
     * @return void
     */
    public function log(?string $msg = null, mixed $value = null)
    {
        if ($msg) {
            Log::info($msg);
        }
        if ($value) {
            Log::info('└──'.$this->convertToJson($value));
        }
        $this->printLn($msg, $value);
    }

    /**
     * Print comparison
     *
     * @return void
     */
    public function printComparison($got = null, $expected = null, $msg = null)
    {
        sort($got);
        sort($expected);
        $this->print($msg, json_encode(['got' => $got, 'Expected' => $expected]));
    }
}
