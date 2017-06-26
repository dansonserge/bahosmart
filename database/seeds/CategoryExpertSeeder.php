<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use App\Answer;


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


        /*factory(App\Question::class, 50)->create()->each(function($u){
           $u->answers()->saveMany(factory(App\Answer::class, 4)->make());
         });*/

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

        //Add Questions

  DB::table('questions')->insert([
         [
           'id'=>1,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"Which company created the most used networking software in the 1980's"
         ],[
           'id'=>2,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"What is the World Wide Web?"
         ],[
           'id'=>3,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"Which of the following operating systems is produced by IBM?"
         ],[
           'id'=>4,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"Which one of the following is a search engine?"
         ],[
           'id'=>5,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"What does the abbreviation HTTP stand for?"
         ],[
           'id'=>6,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"ARPANET, the precursor to the Internet, was developed by:"
         ],[
           'id'=>7,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"Which of the following is not a part of the Internet?"
         ],[
           'id'=>8,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"On what date was the debut of the first IBM Personal Computer?"
         ],[
           'id'=>9,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"What does SSL stand for?"
         ],[
           'id'=>10,
           'category_id'=>1,
           'expert_id'=>3,
           'question_text'=>"The abbreviation URL stands for:"
         ]
     ]);



DB::table('answers')->insert([
         [
           "question_id"=>1,
           "answer_text"=>"Microsoft",
           "is_correct"=>0
         ],[
           "question_id"=>1,
           "answer_text"=>"Sun",
           "is_correct"=>0
         ],[
           "question_id"=>1,
           "answer_text"=>"IBM",
           "is_correct"=>0
         ],[
           "question_id"=>1,
           "answer_text"=>"Novell ",
           "is_correct"=>1
         ],[
           "question_id"=>2,
           "answer_text"=>"A computer game",
           "is_correct"=>0
         ],[
           "question_id"=>2,
           "answer_text"=>"A software program",
           "is_correct"=>0
         ],[
           "question_id"=>2,
           "answer_text"=>"The part of the Internet that enables information-sharing via interconnected pages",
           "is_correct"=>1
         ],[
           "question_id"=>2,
           "answer_text"=>"Another name for the Internet",
           "is_correct"=>0
         ],[
           "question_id"=>3,
           "answer_text"=>"OS-2",
           "is_correct"=>1
         ],[
           "question_id"=>3,
           "answer_text"=>"Windows",
           "is_correct"=>0
         ],[
           "question_id"=>3,
           "answer_text"=>"DOS",
           "is_correct"=>0
         ],[
           "question_id"=>3,
           "answer_text"=>"UNIX ",
           "is_correct"=>0
         ],[
           "question_id"=>4,
           "answer_text"=>"Macromedia Flash",
           "is_correct"=>0
         ],[
           "question_id"=>4,
           "answer_text"=>"Google",
           "is_correct"=>1
         ],[
           "question_id"=>4,
           "answer_text"=>"Netscape",
           "is_correct"=>0
         ],[
           "question_id"=>4,
           "answer_text"=>"Librarians’ Index to the Internet",
           "is_correct"=>0
         ],[
           "question_id"=>5,
           "answer_text"=>"Hypertext Transfer Protocol",
           "is_correct"=>1
         ],[
           "question_id"=>5,
           "answer_text"=>"High Task Termination Procedure",
           "is_correct"=>0
         ],[
           "question_id"=>5,
           "answer_text"=>"Harvard Teletext Proof",
           "is_correct"=>0
         ],[
           "question_id"=>5,
           "answer_text"=>"Hindustan Times Technical Proffesionals",
           "is_correct"=>0
         ],[
           "question_id"=>6,
           "answer_text"=>"FAA",
           "is_correct"=>0
         ],[
           "question_id"=>6,
           "answer_text"=>"Department of Defence",
           "is_correct"=>1
         ],[
           "question_id"=>6,
           "answer_text"=>"NATO",
           "is_correct"=>0
         ],[
           "question_id"=>6,
           "answer_text"=>"UART",
           "is_correct"=>0
         ],[
           "question_id"=>7,
           "answer_text"=>"World Wide Web",
           "is_correct"=>0
         ],[
           "question_id"=>7,
           "answer_text"=>"Email",
           "is_correct"=>0
         ],[
           "question_id"=>7,
           "answer_text"=>"CD-ROM",
           "is_correct"=>1
         ],[
           "question_id"=>7,
           "answer_text"=>"HTTP",
           "is_correct"=>0
         ],[
           "question_id"=>8,
           "answer_text"=>"August 12, 1981",
           "is_correct"=>1
         ],[
           "question_id"=>8,
           "answer_text"=>"January 21 1979",
           "is_correct"=>0
         ],[
           "question_id"=>8,
           "answer_text"=>"August 21, 1980",
           "is_correct"=>0
         ],[
           "question_id"=>8,
           "answer_text"=>"January 12, 1982",
           "is_correct"=>0
         ],[
           "question_id"=>9,
           "answer_text"=>"Secure Socket Layer",
           "is_correct"=>1
         ],[
           "question_id"=>9,
           "answer_text"=>"System Socket Layer",
           "is_correct"=>0,
         ],[
           "question_id"=>9,
           "answer_text"=>"Superuser System Login",
           "is_correct"=>0
         ],[
           "question_id"=>9,
           "answer_text"=>"Secure System Login",
           "is_correct"=>0
         ],[
           "question_id"=>10,
           "answer_text"=>"User Regulation Law",
           "is_correct"=>0
         ],[
           "question_id"=>10,
           "answer_text"=>"Unknown RAM Load",
           "is_correct"=>0
         ],[
           "question_id"=>10,
           "answer_text"=>"Uniform Resource Locator",
           "is_correct"=>1
         ],[
           "question_id"=>10,
           "answer_text"=>"Ultimate RAM Locator",
           "is_correct"=>0
         ]
    
      ]);

    

        }


    }

