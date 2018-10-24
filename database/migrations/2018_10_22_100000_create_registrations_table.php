<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * The name of the database table
     */
    const TABLE = 'registrations' ;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(self::TABLE , function ( Blueprint $table ) {
            $table->increments('id' );
            $table->integer('people_id' );
            $table->integer('group_id' );
            $table->timestamp('date' );
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