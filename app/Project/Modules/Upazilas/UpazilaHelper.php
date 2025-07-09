<?php

namespace App\Project\Modules\Upazilas;

use DB;
use Str;
use App\Upazila;

/** @mixin Upazila */
trait UpazilaHelper
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
     * Set combined code
     * Example code
     *
     * @return $this
     */
    public function setCombinedCode()
    {
        $this->code = pad($this->code, 2);
        $this->combined_code = $this->district->combined_code.$this->code;

        return $this;
    }

    /**
     * This function updates(saves) the denormalize fields with in the same entry
     * for example if in the same module based on client_id it fills other fields
     * like client_name, client_address etc. use setters to set values
     *
     * @return \App\Project\Modules\Upazilas\Upazila
     */

    public function denormalize()
    {
        $district = $this->district;

        $this->division_id = $district->division_id;
        $this->division_name = $district->division_name;
        $this->division_code = $district->division_code;

        $this->district_name = $district->name;
        $this->district_code = $district->code;

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
            // 'paurasavas',
            // 'unions',
            // 'wards',
        ];

        foreach ($tables as $table) {
            DB::table($table)
                ->where('upazila_id', $this->id)
                ->update([
                    'upazila_name' => $this->name,
                    'upazila_code' => $this->code,
                ]);
        }

        // Update admin area combined codes
        //$this->updateRelatedAreas();

    }

    /**
     * @return $this
     */
    public function setNameExt()
    {
        $this->name_ext = $this->name;

        $this->slug = Str::slug($this->name);

        return $this;
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
    // public function isDeletable() { return true; }
    // public function isCloneable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
