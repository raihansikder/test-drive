<?php

namespace App\Mainframe\Features\Report\Traits;

use Cache;
use App\Mainframe\Features\Report\ReportBuilder;

trait ReportControllerTrait
{
    /**
     * Show the application dashboard.
     *
     * @param  string  $key
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function show($key)
    {
        $class = $this->resolveClass($key); // my-demo-class -> MyDemoClass

        if (!class_exists($class)) {
            return $this->fail("Class {$class} not found")->json();
        }

        /** @var ReportBuilder $report */
        $report = new $class;

        if ($this->permissionKeyExists($key)) { // config/mainframe/permissions.php . Define key under 'custom.reports'
            if (!$this->user->can($key)) {
                return $this->permissionDenied();
            }
        }

        return $report->output();

    }

    /**
     * Resolve class to execute the request
     *
     * @param $key
     * @return string
     */
    public function resolveClass($key)
    {
        return Cache::remember('ResolvedClass-for-'.$key, timer('long'), function () use ($key) {
            $class = classFromKey($key);

            // $path defined in controller
            if (isset($this->path)) {
                $path = rtrim($this->path, "\\")."\\".$class;
                if (class_exists($path)) {
                    return $path;
                }
            }

            // If a project is set up use project namespace
            if (project()) {
                $path = projectNamespace().'\Reports\\'.$class;
                if (class_exists($path)) {
                    return $path;
                }

            }

            // Default Mainframe location
            return '\App\Mainframe\Reports\\'.$class;
        });

    }

    /**
     * Check permission
     *
     * @param $key
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function permissionKeyExists($key)
    {
        return config('mainframe.permissions.custom.reports.'.$key);
    }

}
