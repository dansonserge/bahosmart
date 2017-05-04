<?php

$factory->define(App\Answer::class, function (Faker\Generator $faker) {
    static $password;

    return [
     
        'answer_text' => $faker->sentence(5),
        'is_correct' => rand(0,1),
        'status'=>1
        
    ];
});
