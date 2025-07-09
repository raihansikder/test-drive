<?php

namespace App\Project\Modules\Divisions;

use DB;
use Str;
use App\District;

/** @mixin Division */
trait DivisionHelper
{
    /*
    |--------------------------------------------------------------------------
    | Section: Autofill functions 
    |--------------------------------------------------------------------------
    */
    // /**
    //  * Populate model
    //  * return $this
    //  */
    // public function populate()
    // {
    //     return $this;
    // }

    public function syncData()
    {
        /*---------------------------------
        | Update division_name, division_code fields in other tables
        |---------------------------------*/
        $tables = [
            'districts',
            'upazilas',
        ];

        foreach ($tables as $table) {
            DB::table($table)
                ->where('division_id', $this->id)
                ->update([
                    'division_name' => $this->name,
                    'division_code' => $this->code,
                ]);
        }

        // Update Admin Area combined codes
        $this->updateRelatedAreas();

    }

    /**
     * Set name_ext values
     *
     * @return $this
     */
    public function setNameExt()
    {
        if (!$this->hasColumn('name_ext')) {
            return $this;
        }
        if ($this->hasColumn('name')) {
            $this->name_ext = $this->name;
        }

        $this->slug = Str::slug($this->name);

        return $this;
    }

    /**
     * Re-save admin areas which will update the combined codes of each admin area
     *
     * @return void
     */
    public function updateRelatedAreas()
    {
        /**
         * Update the districts combined code
         */
        $this->districts()->each(function ($district, $key) {
            /** @var District $district */
            $district->process()->save();
        });
        // /**
        //  * Update the upazilas combined code
        //  */
        // $this->upazilas()->each(function ($upazila, $key) {
        //     /** @var Upazila $upazila */
        //     $upazila->process()->save();
        // });
        // /**
        //  * Update the paurasavas combined code
        //  */
        // $this->paurasavas()->each(function ($paurasava, $key) {
        //     /** @var Paurasava $paurasava */
        //     $paurasava->process()->save();
        // });
        // /**
        //  * Update the unions combined code
        //  */
        // $this->unionLevels()->each(function ($unionCenter, $key) {
        //     /** @var Union $unionCenter */
        //     $unionCenter->process()->save();
        // });
        // /**
        //  * Update the wards combined code
        //  */
        // $this->wards()->each(function ($ward, $key) {
        //     /** @var Ward $ward */
        //     $ward->process()->save();
        // });
    }
    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    public function isDeletable() { return false; }

    public function isCloneable() { return false; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
