<?php

namespace App\Mainframe\Features\Modular\Immutable;

trait HasImmutables
{
    /**
     * @var array
     */
    public $immutables = [];

    /**
     * Adds an array of fields to existing $immutables array
     *
     * @param  array  $immutables
     * @return $this
     */
    public function addImmutables($immutables = [])
    {
        $this->immutables = array_unique(array_merge($this->immutables, $immutables));

        return $this;
    }

    /**
     * Get a list of immutable fields
     *
     * @return array
     */
    public function get()
    {
        return array_unique($this->immutables);
    }

}
