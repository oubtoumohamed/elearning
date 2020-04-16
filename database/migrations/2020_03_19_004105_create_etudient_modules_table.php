<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudientModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudient_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('etudient_id')->unsigned()->nullable();
            $table->foreign('etudient_id')
                    ->references('id')
                    ->on('etudients')
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
        Schema::dropIfExists('etudient_modules');
    }
}
