<?php

namespace App\Mainframe\Features\Datatable\Traits;

use URL;
use App\Mainframe\Features\Datatable\Datatable;

/** @mixin Datatable */
trait CustomDatatableTrait
{
    /**
     * Ajax URL for json source
     * Note: This method is required if a datatable is extended from module datatable but
     *  put under customer datatable.
     *
     * @return string
     */
    public function ajaxUrl()
    {
        # Important! Check if a URL is already assigned
        if (!$this->ajaxUrl) {
            $this->ajaxUrl = route('datatable.json', classKey($this)); // Default common route for dynamic datatables
        }

        // Pass the current request params to datatable from the current URL of the page
        if ($this->mergeRequest) {
            $this->ajaxUrl = urlWithParams($this->ajaxUrl, parse_url(URL::full(), PHP_URL_QUERY));
        }

        return $this->ajaxUrl;
    }
}
