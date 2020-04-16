<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prof_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prof_id')->unsigned()->nullable();
            $table->foreign('prof_id')
                    ->references('id')
                    ->on('profs')
                    ->onDelete('cascade');
            $table->integer('module_id')->unsigned()->nullable();
            $table->foreign('module_id')
                    ->references('id')
                    ->on('modules')
                    ->onDelete('cascade');

            $table->date('date_affect')->nullable(); 
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
        Schema::dropIfExists('prof_modules');
    }
}
