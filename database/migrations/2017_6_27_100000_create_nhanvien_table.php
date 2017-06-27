<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhanVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hoten','30');
            $table->date('ngaysinh');
            $table->string('quequan','80')->nullable();
            $table->string('dantoc','20')->nullable();
            $table->integer('gioitinh')->nullable();
            $table->string('sdt','20')->nullable();
            $table->integer('ma_phongban')->unsigned();
            $table->integer('ma_chucvu')->unsigned();
            $table->string('password','80');
            $table->string('email','40')->unique();
            $table->integer('is_admin');
            $table->integer('active');
            $table->string('codepass','20')->nullable();   
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
        Schema::dropIfExists('nhanvien');
    }
}
