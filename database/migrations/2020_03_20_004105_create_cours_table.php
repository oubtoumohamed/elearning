<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre')->nullable();
            $table->longText('contenu')->nullable();
            $table->string('type')->nullable();
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

            $table->datetime('start')->nullable(); 
            $table->datetime('end')->nullable(); 
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
        Schema::dropIfExists('cours');
    }
}
