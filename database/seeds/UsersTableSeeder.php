<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([

        ['first_name'=>'John',
         'last_name'=>'Doe',
         'email'=>'johndoe@gmail.com',
         'password'=>Hash::make('qwerty'),
         'user_type'=>0
        ],
        ['first_name'=>'Jane',
         'last_name'=>'Doe',
         'email'=>'janedoe@gmail.com',
         'password'=>Hash::make('qwerty'),
         'user_type'=>0
        ],
        ['first_name'=>'James',
         'last_name'=>'Doe',
         'email'=>'jamesdoe@gmail.com',
         'password'=>Hash::make('qwerty'),
         'user_type'=>0
        ],
        ['first_name'=>'Serge',
         'last_name'=>'Danson',
         'email'=>'sergedanson@gmail.com',
         'password'=>Hash::make('qwerty'),
         'user_type'=>7
        ]
        /**
         * User_type as: 
         * 7 = an administrator
         * 1 = an Expert
         * 0 = a regular user (default)
         */
      ]);
     }
  }
