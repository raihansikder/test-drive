<?php

namespace App\Mainframe\Features\Modular\BaseModule\Traits;

trait HasHidden
{
    /**
     * Array of field names that should be hidden.
     * Add this in the parent class.
     *
     * @var array
     */
    public $hidden = [];

    /**
     * Set hidden fields
     *
     * @return $this
     */
    public function setHidden($fields = [])
    {
        $this->hidden = $fields;

        return $this;
    }

    /**
     * Merge hidden fields
     *
     * @param  array  $fields
     * @return $this
     */
    public function mergeHidden($fields = [])
    {
        $this->hidden = array_unique(array_merge($this->hidden, $fields));

        return $this;
    }

    /**
     * Remove fields from hidden array
     *
     * @param  array  $fields
     * @return $this
     */
    public function removeHidden($fields = [])
    {
        $this->hidden = array_unique(array_values(array_diff($this->hidden, $fields)));

        return $this;
    }
}
