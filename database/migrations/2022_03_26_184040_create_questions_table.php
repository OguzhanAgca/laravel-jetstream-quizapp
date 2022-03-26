<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id('question_id');
            $table->unsignedBigInteger('quiz_id');
            $table->string('question_image')->nullable(true);
            $table->longText('question');
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('answer_c');
            $table->string('answer_d');
            $table->enum('correct_answer', ['answer_a', 'answer_b', 'answer_c', 'answer_d'])->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('quiz_id')->references('quiz_id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
