<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_photos', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
			$table->string('name');
			$table->string('thumbnail_path');
			$table->string('photo_path');
			$table->string('caption')->nullable();
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
        Schema::drop('article_photos');
    }
}
