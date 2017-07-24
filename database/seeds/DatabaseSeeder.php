<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('position')->insert([
            'name' => 'trưởng phòng',           
        ]);
        DB::table('position')->insert([
            'name' => 'nhân viên',           
        ]);
        DB::table('position')->insert([
            'name' => 'phó phòng',           
        ]);
        DB::table('department')->insert([
            'name' => 'd3',
            'address' => 'tang 3 toa nha disco ',
            'phone' => '01659322311'
        ]);
        DB::table('department')->insert([
            'name' => 'd2',
            'address' => 'tang 3 toa nha disco ',
            'phone' => '0123456789'
        ]);
        DB::table('staff')->insert([
            'name' => 'nguyen dinh quy',
            'birthday'=> '1994-02-04',
            'id_department'=> '1',
            'id_position'=> '1', 
            'password' => bcrypt('12345678'),
            'email' => 'nguyendinhquy94@gmail.com',
            'is_admin'=> '1',
            'active'=> '1',
            'codepass'=> str_random(10)
        ]);
        DB::table('staff')->insert([
            'name' => 'quynd',
            'birthday'=> '1994-02-04',
            'id_department'=> '1',
            'id_position'=> '1', 
            'password' => bcrypt('12345678'),
            'email' => 'quynd@rikkeisoft.com',
            'is_admin'=> '1',
            'active'=> '1',
            'codepass'=> str_random(10)
        ]);
        DB::table('staff')->insert([
            'name' => 'lailn',
            'birthday'=> '1994-02-04',
            'id_department'=> '1',
            'id_position'=> '1', 
            'password' => bcrypt('12345678'),
            'email' => 'quynd@gmail.com',
            'is_admin'=> '1',
            'active'=> '1',
            'codepass'=> str_random(10)
        ]);
        DB::table('staff')->insert([
            'name' => 'user 1 ',
            'birthday'=> '1994-02-04',
            'id_department'=> '1',
            'id_position'=> '1', 
            'password' => bcrypt('12345678'),
            'email' => '12345@gmail.com',
            'is_admin'=> '1',
            'active'=> '1',
            'codepass'=> str_random(10)
        ]);
    }
}