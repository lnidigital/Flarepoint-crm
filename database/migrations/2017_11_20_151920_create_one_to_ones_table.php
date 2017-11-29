<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOneToOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oneto_ones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('first_contact_id')->unsigned();
            $table->foreign('first_contact_id')->references('id')->on('contacts');
            $table->integer('second_contact_id')->unsigned();
            $table->foreign('second_contact_id')->references('id')->on('contacts');
            $table->datetime('onetoone_date');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('meeting_id')->unsigned()->nullable();
            $table->foreign('meeting_id')->references('id')->on('meetings');
            $table->text('description');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('oneto_ones');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
    }
}
