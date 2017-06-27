<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhanvien')->insert([
            'hoten' => str_random(10),
            'ngaysinh'=> '1994-02-04',
            'ma_phongban'=> '1',
            'ma_chucvu'=> '1',
            'password' => bcrypt('secret'),
            'email' => str_random(10).'@gmail.com',
            'is_admin'=> '1',
            'active'=> '1',
            'codepass'=> str_random(10)
        ]);
    }
}