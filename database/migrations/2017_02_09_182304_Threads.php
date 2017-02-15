<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Threads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('url')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('author', 100);
            $table->string('avatar')->nullable();
            $table->string('lastPostAuthor');
            $table->dateTimeTz('startDate');
            $table->dateTimeTz('lastPostDate');
            $table->unsignedTinyInteger('rating');
            $table->boolean('sticky');
            $table->string('views');
            $table->string('replies');
            $table->unsignedSmallInteger('pages');
            $table->integer('posts')->nullable();
            $table->double('sentiment')->nullable();
            $table->double('confidence')->nullable();
            $table->double('controversy')->nullable();
            $table->double('hotness')->nullable();
            $table->boolean('indexed')->default(false);
            $table->timestampTz('indexDate')->nullable();
            $table->timestampsTz();
            $table->softDeletes();
            $table->index(['title', 'author', 'url']);
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('threads');
    }
}
