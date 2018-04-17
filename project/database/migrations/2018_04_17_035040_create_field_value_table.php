<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_value', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('field_id')->unsigned();
            $table->integer('advertisement_id')->unsigned();
            $table->string('value');

            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_value');
    }
}
