<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsvpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rsvps', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('guest_id')->unsigned();
			$table->integer('total_adults')->unsigned();
            $table->integer('total_children')->unsigned();
            $table->enum('registered_by', ['admin', 'guest'])->default('guest');
            $table->timestamps();

            $table
                ->foreign('guest_id')
                ->references('id')
                ->on('guests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rsvps');
    }
}
