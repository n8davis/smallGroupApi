<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonAddressesTable extends Migration
{
    /**
     * The name of the database table
     */
    const TABLE = 'people_addresses' ;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE , function ( Blueprint $table ) {
            $table->increments('id' );
            $table->string('line1' );
            $table->string('line2' );
            $table->string('city' );
            $table->string('state' );
            $table->string('zip' );
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
        Schema::drop(self::TABLE );
    }
}