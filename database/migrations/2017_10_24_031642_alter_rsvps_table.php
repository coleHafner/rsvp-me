<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRsvpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rsvps', function (Blueprint $table) {
             // make guest id optional
             $table->integer('guest_id')
                ->unsigned()
                ->nullable(true)
                ->change();
             
            // add phone number
            $table
                ->string('phone')
                ->nullable();

            $table
                ->string('guest_name')
                ->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rsvps', function (Blueprint $table) {


        });
    }
}
