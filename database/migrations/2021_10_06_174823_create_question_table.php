<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments("id");
            $table->string('title');
            $table->longText('body')->nullable();
            $table->string('slug')->unique();
            $table->integer("question_category_id");
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onUpdate('cascade')
                ->onDelete('cascade')
            ;
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
}
