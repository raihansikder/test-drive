<?php

namespace App\Project\Traits\Processor;

use App\Project\Features\Modular\BaseModule\BaseModule;

trait CheckUniqueCombinedCodeTrait
{
    /**
     * Check if the combined code is unique
     *
     * @return $this
     */
    public function checkUniqueCombinedCode()
    {
        /** @var BaseModule $element */
        $element = $this->element;

        $matched = $element->where('combined_code', $element->combined_code)
            ->when($element->id, function ($query, $id) {
                $query->where('id', '!=', $id);
            })
            ->first();

        if ($matched) {
            $this->error('The combined code is note unique. Please update the code', 'combined_code');
            $this->error('Please change the code', 'code');
        }

        return $this;

    }

}
