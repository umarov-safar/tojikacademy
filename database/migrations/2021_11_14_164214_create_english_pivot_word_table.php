<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishPivotWordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_pivot_word', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('word_id')
                ->unsigned()
                ->index();
            $table->foreign('word_id')
                ->references('id')
                ->on('english_words')
                ->onDelete('cascade');

            $table->unsignedBigInteger('related_word_id')
                ->unsigned()
                ->index();
            $table->foreign('related_word_id')
                ->references('id')
                ->on('english_words')
                ->onDelete('cascade');

            $table->unique(['word_id', 'related_word_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('english_pivot_word');
    }
}
