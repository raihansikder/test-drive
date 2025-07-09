<?php

namespace App\Mainframe\Features\Form\Text;

use App\Mainframe\Features\Form\Input;

class Tags extends Input
{
    public $tags;
    public $separator;

    public function __construct($var = [], $element = null)
    {
        parent::__construct($var, $element);
        $this->tags = $var['tags'] ?? [];
        $this->separator = $var['separator'] ?? ',';
    }

    public function tags()
    {
        return implode("','", $this->tags);
    }

    /**
     * The value should be CSV value
     *
     * @return string
     */
    public function value()
    {
        $value = parent::value();

        if (is_array($value)) {
            return csvFromArray($value);
        }

        return trim($value, '[]');
    }

}
