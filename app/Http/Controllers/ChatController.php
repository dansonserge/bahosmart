<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\User;
use App\RoomUser;
use App\Message;

use App\Customs\Chat;
use DB;


use Illuminate\Support\Facades\Redis as LRedis;



class ChatController extends Controller
{


	public function getPrivateRoom(Request $request){
      
      $is_room_exists_one=Room::where('user_one',$request->user_one_id)->where('user_two',$request->user_two_id)->count();

        $is_room_exists_two=Room::where('user_one',$request->user_two_id)->where('user_two',$request->user_one_id)->count();



       if($is_room_exists_one>0){

          $room=Room::where('user_one',$request->user_one_id)->where('user_two',$request->user_two_id)->get();
         

           
		      $chat_obj=new Chat;
		      $chats=$chat_obj->getChats($room[0]->id);

              $current_room=Room::where('id',$room[0]->id)->with('users')->get();

		

			  $data=[
				        'channel_type'=>'get_room',
		                'room_id'=>$current_room[0]->id,
		                'user_one'=>$current_room[0]->user_one,
		                'user_two'=>$current_room[0]->user_two,
		                'chats'=>$chats
	                ];

        return $data;

       }
       else if($is_room_exists_two>0){
       	   $room=Room::where('user_one',$request->user_two_id)->where('user_two',$request->user_one_id)->get();
           $chat_obj=new Chat;
           $chats=$chat_obj->getChats($room[0]->id);
           $current_room=Room::where('id',$room[0]->id)->with('users')->get();
           
          $data=[
		        'channel_type'=>'get_room',
                'room_id'=>$current_room[0]->id,
                'user_one'=>$current_room[0]->user_one,
                'user_two'=>$current_room[0]->user_two,
                'chats'=>$chats
	           ];

        return $data;




       }

       else{
        
        $user_one=User::find($request->user_one_id);
	    $user_two=User::find($request->user_two_id);

		$room=new Room;
		$room->room_type='private';

		$room->user_one=$request->user_one_id;
		$room->user_two=$request->user_two_id;

		$room->save();

		$room->users()->attach($user_one);
		$room->users()->attach($user_two);
		   
		$current_room=Room::where('id',$room->id)->with('users')->get();

		

		$data=[
		       'channel_type'=>'get_room',
               'room_data'=>$current_room
               ];

        return $data;



       }
    }

	public function addChat(Request $request){

	   $sender=User::find($request->sender_id);

	   $message=new Message;
	   $message->room_id=$request->room_id;
	   $message->sender_id=$request->sender_id;
	   $message->receiver_id=$request->receiver_id;
	   $message->chat=$request->chat;

	   $message->save();


		$data=['channel_type'=>'chats_tunnel',
		       'sender'=>$sender,
		       'receiver_id'=>$request->receiver_id,
		       'room_id'=>$request->room_id,
		       'chat'=>$request->chat,
		       'user_two_id'=>$request->receiver_id
		      ];
		  

      $redis = LRedis::connection();
  
      $redis->publish('RealTimeChannel',json_encode($data));
     



      return response()->json(['success'=>1,'failure'=>0,'msg'=>$data],200);

}

    public function getMesageData($room_id){


      $chat_obj=new Chat;
      $chats=$chat_obj->getChats($room_id);

      return $chats;


    }

	
}
