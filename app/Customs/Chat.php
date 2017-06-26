<?php

namespace App\Customs;

use App\Message;
use App\Room;
use App\User;


class Chat{

public function getChats($room_id){
  

   $chats=Message::where('room_id',$room_id)->get();


   return $chats;
}


}