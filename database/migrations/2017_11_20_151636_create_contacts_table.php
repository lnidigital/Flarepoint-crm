<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contacts');
        
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('primary_number')->nullable();
            $table->string('secondary_number')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('company_name');
            $table->string('image_path')->nullable();
            $table->datetime('join_date')->nullable();
            $table->string('status')->default(1); // 1=member, 2=guest, 3=ex-member
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('referrer_id')->nullable()->unsigned();
            $table->foreign('referrer_id')->references('id')->on('contacts');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('industry_id')->nullable()->unsigned();
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->unique(array('email','group_id'));
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
        Schema::dropIfExists('contacts');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
    }
}
