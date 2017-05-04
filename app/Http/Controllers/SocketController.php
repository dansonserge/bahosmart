<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redis as LRedis;

use App\Events\SocketTest;
use App\Events\SocketTestQuiz;

use App\Chat;

class SocketController extends Controller
{
    

     public function postNewTest(Request $request){
      
      $chat=new Chat;

      $message=$request->chat;

      $chat->sender_id=$request->sender_id;

      $chat->receiver_id=$request->receiver_id;

      $chat->chat=$request->chat;

      $chat->read=false;

      $chat->save();

      $redis = LRedis::connection();
  
      $redis->publish('quiz', $request->chat);

	    $redis->publish('message', 'testing message');




      //event(new SocketTest($message));

     //event(new SocketTestQuiz($message));

	 	 // return response()->json(['success'=>1,'failure'=>0],200);

    }


public function getMessages($sender_id,$receiver_id){
       
$messages=Chat::where('sender_id',$sender_id)->where('receiver_id',$receiver_id)->get();

    return response()->json(['success'=>1,'failure'=>0, 'chats'=> $messages],200);
  }
}











 