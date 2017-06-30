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
        DB::table('department')->insert([
            'name' => str_random(10),
            'address' => str_random(30),
            'phone' => str_random(10)
        ]);
        DB::table('staff')->insert([
            'name' => str_random(10),
            'birthday'=> '1994-02-04',
            'id_department'=> '1',
            'id_position'=> '1', 
            'password' => bcrypt('12345678'),
            'email' => 'quynd@gmail.com',
            'is_admin'=> '1',
            'active'=> '1',
            'codepass'=> str_random(10)
        ]);
    }
}