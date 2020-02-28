<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->primary(['client_id', 'restaurant_id']);

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('restaurant_id');            
            $table->string('comment');
            $table->float('score');
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');            
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

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
        Schema::dropIfExists('reviews');
    }
}
