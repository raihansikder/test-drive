<?php

namespace App\Project\Modules\Districts;

use DB;
use Str;
use App\Ward;
use App\Union;
use App\Upazila;
use App\Paurasava;

/** @mixin District */
trait DistrictHelper
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

    /**
     * Set name_ext  (Separate by »)
     *
     * @return $this
     */

    public function setNameExt()
    {
        if (!$this->hasColumn('name_ext')) {
            return $this;
        }
        if ($this->hasColumn('division_name')) {
            $this->name_ext = $this->division_name;
        }
        $this->slug = Str::slug($this->name);

        return $this;
    }

    /**
     * Set combined code
     * Example code
     *
     * @return $this
     */
    public function setCombinedCode()
    {
        $this->code = pad($this->code, 2);
        $this->combined_code = $this->division->code.$this->code;

        return $this;
    }

    /**
     * This function updates(saves) the denormalize fields with in the same entry
     * for example if in the same module based on client_id it fills other fields
     * like client_name, client_address etc. use setters to set values
     *
     * @return District
     */
    public function denormalize()
    {
        $division = $this->division;
        $this->division_name = $division->name;
        $this->division_code = $division->code;

        return $this;
    }

    /**
     * This function updates(saves) other tables where changes of this model should reflect
     *
     * @return void
     */
    public function syncData()
    {
        /*---------------------------------
        | Update division_name, division_code fields in other tables
        |---------------------------------*/
        $tables = [
            'upazilas',
        ];

        foreach ($tables as $table) {
            DB::table($table)
                ->where('district_id', $this->id)
                ->update([
                    'district_name' => $this->name,
                    'district_code' => $this->code,
                ]);
        }

        // Update admin area combined codes
        $this->updateRelatedAreas();
    }

    /**
     * Re-save admin areas which will update the combined codes of each admin area
     *
     * @return void
     */
    public function updateRelatedAreas()
    {
        /**
         * Update the upazilas combined code
         */
        $this->upazilas()->each(function ($upazila, $key) {
            /** @var Upazila $upazila */
            $upazila->process()->save();
        });
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

    public function isCloneable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
