<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('test','HomeController@getTest');
$api = app('Dingo\Api\Routing\Router');



$api->version('v1',function($api){
  //test
  $api->get('dingocheck','App\Http\Controllers\HomeController@getDingoCheck');


  	//initial data
  $api->get('initial_data','App\Http\Controllers\HomeController@getInitialData');
  
   //sign up
  $api->post('signup','App\Http\Controllers\UserController@postSignup');

  //check whether a user has followed any category
  $api->post('user_cats','App\Http\Controllers\UserController@postUserCategories');

//all categories
  $api->get('categories','App\Http\Controllers\HomeController@getCategories');
  
 // all categories fractal transformed
  $api->post('user_categories','App\Http\Controllers\UserController@postCategories');
  
  $api->post('follow/category','App\Http\Controllers\UserController@postFollowCategory');

  //show users to follow based on categories a user followed
  $api->post('follow/users','App\Http\Controllers\UserController@postFollowUsers');

  //follow users
  $api->post('follow/user','App\Http\Controllers\UserController@postFollowUser');

  //add a post
  $api->post('new/post','App\Http\Controllers\PostController@postNewPost');
   
   //add a comment
  $api->post('new/comment','App\Http\Controllers\PostController@postNewComment');

  //show posts of this user 
  $api->get('user/posts/{user_id}','App\Http\Controllers\PostController@getPosts');
  
  // show posts of users this user follow
  $api->get('user/feeds/{user_id}','App\Http\Controllers\PostController@getFeeds');
  
  //like and dislike a post
  $api->post('new/like','App\Http\Controllers\PostController@postLike');

  //show single post
  $api->get('single_post/{post_id}/{user_id}','App\Http\Controllers\PostController@getSinglePost');

  //test socket
  $api->post('new/test','App\Http\Controllers\SocketController@postNewTest');

  //read messages
  $api->get('messages/{sender_id}/{receiver_id}','App\Http\Controllers\SocketController@getMessages');

  //apply for expert account
  $api->post('apply/expert','App\Http\Controllers\UserController@applyForExpertAccount');
  
  //View Expert account applications
   $api->get('apply/expert/applications','App\Http\Controllers\UserController@viewExpertAccountApplications'); 

  //Confirm expert 
  $api->post('apply/expert/confirm','App\Http\Controllers\UserController@confirmExpertAccount');

    //add questions
    $api->post('expert/add_question','App\Http\Controllers\UserController@addQuestions');

 //add answers
    $api->post('expert/add_answer','App\Http\Controllers\UserController@addAnswer');

//edit question
    $api->post('expert/edit_question','App\Http\Controllers\UserController@editQuestion');

//edit answer
    $api->post('expert/edit_answer','App\Http\Controllers\UserController@editAnswer');

//put the question live
     $api->get('expert/put_question_live','App\Http\Controllers\UserController@putQuestionLive'); 

     //delete question

     $api->post('expert/delete/question','App\Http\Controllers\UserController@deleteQuestion');

     //view question and answers

     $api->get('expert/questions/{expert_id}','App\Http\Controllers\UserController@viewQuestions'); 

     //request for a challenge
     $api->post('users/quiz/request','App\Http\Controllers\ChallengeController@requestChallenge');

//User two accepts the request
     $api->post('users/quiz/accept','App\Http\Controllers\ChallengeController@acceptRequest');

//start quiz
     $api->post('users/quiz/start','App\Http\Controllers\ChallengeController@usersStartQuiz');

//add users' quiz answers
     $api->post('users/quiz/answers','App\Http\Controllers\ChallengeController@usersQuizAnswers');

//generate quiz report
     $api->get('users/quiz/report/{session_id}','App\Http\Controllers\ChallengeController@quizReport');


//check followers
     $api->get('user/followers/{user_id}','App\Http\Controllers\UserController@myFollowers');

//accept challenge call
     $api->post('users/challenge-call/cancel','App\Http\Controllers\ChallengeController@challengeCallCancel');





});

