<?php

namespace App\Mainframe\Features\Modular\BaseModule\Traits;

use Arr;

trait HasHidden
{
    /**
     * Array of items (e.g., field names) that should be hidden.
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
    public function setHidden(array|string $items)
    {
        $items = Arr::wrap($items);
        $this->hidden = $items;

        return $this;
    }

    /**
     * Merge hidden fields
     *
     * @param  array|string  $items
     * @return $this
     */
    public function mergeHidden(array|string $items)
    {
        $items = Arr::wrap($items);
        $this->hidden = array_unique(array_merge($this->hidden, $items));

        return $this;
    }

    /**
     * Remove fields from the $hidden array
     *
     * @param  array|string  $items
     * @return $this
     */
    public function removeHidden(array|string $items)
    {
        $items = Arr::wrap($items);
        $this->hidden = array_unique(array_values(array_diff($this->hidden, $items)));

        return $this;
    }
}
