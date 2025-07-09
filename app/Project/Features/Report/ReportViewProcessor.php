<?php

namespace App\Project\Features\Report;

use App\Project\Features\Core\ViewProcessor;

class ReportViewProcessor extends ViewProcessor
{
    /**
     * ReportViewProcessor constructor.
     *
     * @param $reportBuilder
     */
    public function __construct($reportBuilder)
    {
        parent::__construct();
        $this->report = $reportBuilder;
    }

}
