<?php

use Illuminate\Database\Seeder;
use App\User;

class CategoryExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seed Application
        DB::table('category_expert')->insert([

           [
            'id'=>1,
            'category_id'=>1,
             'user_id'=>3,
             'educational_background'=>'bachelor degree',
			 'description'=>'I am good at developing apps',
			 'status'=>1
             ]
            ]);

        $user=User::find(3);
        $user->telephone='0784826188';
        $user->user_type=1;
        $user->save();

      
        //Seed Application approval
        DB::table('admin_expert')->insert([
              
              [
                'admin_id'=>4,
                'application_id'=>1,
                'action'=>'confirm',
                'reason'=>'eligible'
              ]

        	]);


        //Generating QUESTIONS & ANSWERS


        factory(App\Question::class, 50)->create()->each(function($u){
           $u->answers()->saveMany(factory(App\Answer::class, 4)->make());
         });

        //Seed Packs

        DB::table('packs')->insert([
              
              [
                'name'=>'Basic',
                'questions'=>5,
                'status'=>1
               ],
               [
                'name'=>'Moderate',
                'questions'=>10,
                'status'=>1
               ],
               [
                'name'=>'Advanced',
                'questions'=>15,
                'status'=>1
               ],

          ]);

    

        }


    }

