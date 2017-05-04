<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([

            [
              'user_id'=>'1',
              'category_id'=>'1',
              'title'=>'API',
              'post_text'=>'API in full is Application Programming Interface, it helps two platforms to communicate',
              'image'=>'images/posts/1475128418.jpg'
            ]
           
        	
          ]);
    }
}
