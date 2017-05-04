<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
             ['user_id'=>'1',
              'post_id'=>'1',
              'text'=>'API in full is Application Programming'
              ]
            ]);
    }
}
