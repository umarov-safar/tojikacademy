<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishWordPivotCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_word_pivot_category', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('word_id')
                ->unsigned()
                ->index();
            $table->foreign('word_id')
                ->references('id')
                ->on('english_words')
                ->onDelete('cascade');

            $table->unsignedBigInteger('word_category_id')
                ->unsigned()
                ->index();
            $table->foreign('word_category_id')
                ->references('id')
                ->on('word_categories')
                ->onDelete('cascade');

            $table->unique(['word_id', 'word_category_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('english_word_pivot_category');
    }
}
