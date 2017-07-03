<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('name','30');
            $table->date('birthday');
            $table->string('address','80')->nullable();
            $table->string('country','20')->nullable();
            $table->integer('sex')->nullable();
            $table->string('phone','20')->nullable();
            $table->integer('id_department')->unsigned();
            $table->integer('id_position')->unsigned();
            $table->string('password');
            $table->string('email','40')->unique();
            $table->integer('is_admin');
            $table->integer('active');
            $table->string('codepass','20')->nullable();   
            $table->rememberToken();
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
        Schema::dropIfExists('staff');
    }
}
