<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $password = Hash::make('Sufi*1234');
        $entry = [
            ['id'=>3,'name'=>'subadmin','type'=>'subadmin','mobile'=>'03218491397','image'=>'','email'=>'subadmin@gmail.com','password'=>$password,'status'=>1],
            ['id'=>4,'name'=>'subadmin2','type'=>'subadmin','mobile'=>'000000000','image'=>'','email'=>'subadmin2@gmail.com','password'=>$password,'status'=>1],
            
        ];
        Admin::insert($entry);
    }
}
