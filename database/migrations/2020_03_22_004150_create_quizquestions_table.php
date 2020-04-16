<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizquestions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->longText('contenu')->nullable();
            $table->integer('cours_id')->unsigned()->nullable();
            $table->foreign('cours_id')
                    ->references('id')
                    ->on('cours')
                    ->onDelete('cascade');
            $table->string('type')->nullable();
            $table->longText('reponses')->nullable();

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
        Schema::dropIfExists('quizquestions');
    }
}
