<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_contact_id')->unsigned();
            $table->foreign('from_contact_id')->references('id')->on('contacts');
            $table->integer('to_contact_id')->unsigned();
            $table->foreign('to_contact_id')->references('id')->on('contacts');
            // $table->integer('from_member_id')->unsigned();
            // $table->integer('to_member_id')->unsigned();
            $table->datetime('referral_date');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('referrals');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
