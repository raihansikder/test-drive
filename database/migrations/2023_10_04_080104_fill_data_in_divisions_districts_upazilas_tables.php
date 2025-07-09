<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillDataInDivisionsDistrictsUpazilasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('divisions')) {
            DB::statement('TRUNCATE TABLE divisions');
            DB::unprepared(File::get(database_path().'/scripts/divisions.sql'));
        }
        if (Schema::hasTable('districts')) {
            DB::statement('TRUNCATE TABLE districts');
            DB::unprepared(File::get(database_path().'/scripts/districts.sql'));
        }
        if (Schema::hasTable('upazilas')) {
            DB::statement('TRUNCATE TABLE upazilas');
            DB::unprepared(File::get(database_path().'/scripts/upazilas.sql'));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
