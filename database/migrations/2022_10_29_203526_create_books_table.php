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
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->unsigned(); //chnage this line
            $table->foreignId('author_id')->unsigned()->nullable();
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->text('genre');
            $table->bigInteger('credit_price');
            $table->text('file')->nullable();
            $table->string('status')->default('availiable'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
