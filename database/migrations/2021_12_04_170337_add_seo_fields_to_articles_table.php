<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoFieldsToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('description')->after('title');
            $table->text('image_sizes')->nullable();
            $table->string('meta_title');
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['description', 'meta_title', 'meta_description', 'meta_keywords', 'image_size']);
        });
    }
}
