<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudientFiliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudient_filiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('etudient_id')->unsigned()->nullable();
            $table->foreign('etudient_id')
                    ->references('id')
                    ->on('etudients')
                    ->onDelete('cascade');
            $table->integer('filier_id')->unsigned()->nullable();
            $table->foreign('filier_id')
                    ->references('id')
                    ->on('filiers')
                    ->onDelete('cascade');

            $table->integer('year')->nullable(); 
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
        Schema::dropIfExists('etudient_filiers');
    }
}
