<?php


$factory->define(App\Question::class, function (Faker\Generator $faker) {
  

    return [
        'category_id' =>1,
        'expert_id' =>1,
        'status'=>1,
        'question_text' => $faker->sentence(5)
    ];
});
