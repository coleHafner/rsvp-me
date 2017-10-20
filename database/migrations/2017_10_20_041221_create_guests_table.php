<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id')->unsigned();
			$table->integer('address_id')->unsigned();
			$table->string('party_name');
			$table->integer('total_adults');
			$table->integer('total_children');
			$table->integer('total_expected');
            $table->timestamps();

			$table
				->foreign('address_id')
				->references('id')
				->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
