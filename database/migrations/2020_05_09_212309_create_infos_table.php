<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->tinyInteger('triage_status');
            $table->string('report_slug');
            $table->string('reporter_name', 60)->nullable();
            $table->string('assetURL');
            $table->string('weakness')->nullable();
            $table->string('otherWeakness')->nullable();
            $table->string('severity')->nullable();
            $table->string('severity_calc')->nullable();
            $table->string('bug_name');
            $table->longText('desc');
            $table->longText('impact');
            $table->longText('steps_of_reproduce');
            $table->longText('exploitation');
            $table->longText('fixation');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
    }
}
