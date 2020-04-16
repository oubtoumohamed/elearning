<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('contenu')->nullable();
            $table->integer('cours_id')->unsigned()->nullable();
            $table->foreign('cours_id')
                    ->references('id')
                    ->on('cours')
                    ->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->boolean('readed')->nullable();
            $table->integer('question_id')->unsigned()->nullable();
            $table->foreign('question_id')
                    ->references('id')
                    ->on('cours_questions')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('cours_questions');
    }
}
