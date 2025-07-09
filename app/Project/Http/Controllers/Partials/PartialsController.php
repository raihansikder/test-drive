<?php

namespace App\Project\Http\Controllers\Partials;

use Str;
use App\Upazila;
use App\Division;
use App\District;
use App\Project\Http\Controllers\BaseController;

class PartialsController extends BaseController
{

    // Todo: Remove demo code
    public function test() { }

    public function districtAddModal()
    {
        $uuid = Str::uuid();

        return view('project.partials.district-add-modal')
            ->with([
                'division' => Division::find(request('division_id')),
                'element' => new District(['uuid' => $uuid]), // Instantiate a new model with UUID
                'uuid' => $uuid, // Pass the UUID so that it can be used by uploads
            ])
            ->render();

    }

    public function upazilaAddModal()
    {
        $uuid = Str::uuid();

        return view('project.partials.upazila-add-modal')
            ->with([
                'district' => District::find(request('district_id')),
                'element' => new Upazila(['uuid' => $uuid]), // Instantiate a new model with UUID
                'uuid' => $uuid, // Pass the UUID so that it can be used by uploads
            ])
            ->render();

    }

}
