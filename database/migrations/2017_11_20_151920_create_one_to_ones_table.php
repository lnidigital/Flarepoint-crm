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
            $table->integer('first_member_id')->unsigned();
            $table->foreign('first_member_id')->references('id')->on('members');
            $table->integer('second_member_id')->unsigned();
            $table->foreign('second_member_id')->references('id')->on('members');
            // $table->integer('from_member_id')->unsigned();
            // $table->integer('to_member_id')->unsigned();
            $table->datetime('onetoone_date');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
            //$table->integer('group_id')->unsigned();
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
        Schema::dropIfExists('oneto_ones');
    }
}
