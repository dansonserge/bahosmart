<?php

use Illuminate\Database\Seeder;

class Category_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_users')->insert([

            ['user_id'=>'1','category_id'=>'1'],
             ['user_id'=>'1','category_id'=>'2']
           
        	
          ]);
    }
}
