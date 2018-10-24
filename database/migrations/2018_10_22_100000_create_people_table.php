<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * The name of the database table
     */
    const TABLE = 'people' ;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE , function ( Blueprint $table ) {
            $table->increments('id' );
            $table->string('name' , 100 );
            $table->string('email' , 255 );
            $table->string('phone' , 20 );
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