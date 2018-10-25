<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRadiologyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radiology_details', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE radiology_details CHANGE  COLUMN type radiology_id int NULL;');
            DB::statement('ALTER TABLE radiology_details CHANGE  COLUMN subtype spine_id int NULL;');
            DB::statement('ALTER TABLE radiology_details CHANGE  COLUMN bodyparts bodyparts_id int NULL;');
            DB::statement('ALTER TABLE radiology_details CHANGE  COLUMN qualifiers qualifiers_id int NULL;');
            DB::statement('ALTER TABLE radiology_details CHANGE  COLUMN special_request special_request_id int NULL;');
            DB::statement('ALTER TABLE radiology_details CHANGE  COLUMN body_part_side body_part_side_id int NULL;');
            $table->text('bodyparts_other')->nullable();
            $table->text('bodyparts_text')->nullable();
            $table->text('qualifiers_text')->nullable();
            $table->text('special_request_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('radiology_details', function (Blueprint $table) {
            //
        });
    }
}
