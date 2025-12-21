<?php

namespace App\Mainframe\Features\Modular\Immutable;

trait HasImmutables
{
    /**
     * Array of database field names that are immutable.
     * Add this in the parent class.
     *
     * @var array
     */
    public $immutables = [];

    /**
     * @return $this
     */
    public function setImmutables($fields = [])
    {
        $this->immutables = $fields;

        return $this;
    }

    /**
     * Get a list of immutable fields
     *
     * @return array
     *
     * @depricated use immutables()
     */
    public function getImmutables()
    {
        return $this->immutables();
    }

    /**
     * Define the immutables in an array and return.
     *
     * @return string[]
     */
    public function immutables()
    {
        return array_unique($this->immutables);
    }

    /**
     * Merge immutables with existing immutables
     *
     * @param  array  $fields
     * @return $this
     *
     * @deprecated  use mergeImmutables
     */
    public function addImmutables($fields = [])
    {
        return $this->mergeImmutables($fields);
    }

    /**
     * Merge immutables with existing immutables
     *
     * @param  array  $fields
     * @return $this
     */
    public function mergeImmutables($fields = [])
    {
        $this->immutables = array_unique(array_merge($this->immutables, $fields));

        return $this;
    }

    /**
     * Remove fields from hidden array
     *
     * @param  array  $fields
     * @return $this
     */
    public function removeImmutables($fields = [])
    {
        $this->immutables = array_unique(array_values(array_diff($this->immutables, $fields)));

        return $this;
    }
}
