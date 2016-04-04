<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reposts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('new_post_id');
            // ->unsigned()->index();
            // $table->foreign('new_post_id')->references('id')->on('posts')->onDelete('no action');
            $table->integer('orig_post_id');
            // ->unsigned()->index();
            // $table->foreign('orig_post_id')->references('id')->on('posts')->onDelete('no action');

            $table->integer('reposter_id');
            $table->integer('orig_poster_id');
            
            $table->string('orig_post_title');
            $table->string('orig_post_text');
            $table->string('orig_post_data');

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
        Schema::drop('reposts');
    }
}
