<?php

namespace App\Mainframe\Helpers;

class Convert
{
    /**
     * Convert CSV to array.
     *
     * @param  string|mixed  $val
     * @return array
     */
    public static function csvToArray($val)
    {
        if (is_array($val)) {
            return $val;
        }
        return Sanitize::array(explode(',', Sanitize::csv($val)));
    }

    /**
     * Convert CSV to array.
     *
     * @param  array  $array
     * @return string
     */
    public static function arrayToCsv($val)
    {
        if (is_string($val)) {
            return $val;
        }
        return implode(',', Sanitize::array($val));
    }

    /**
     * Convert a string to array. The string can be csv '1,2,3' or array expression '[1,2,3]'
     *
     * @param $str
     * @return array
     */
    public static function strToArray($str)
    {
        return array_map(null, explode(',', trim($str, '[],')));
    }
}
