  var app = require('express')();
  var server = require('http').Server(app);
  var io = require('socket.io')(server);
  var redis = require('ioredis');
 
  server.listen(8890);

  io.on('connection', function (socket) {

  console.log("new client connected");

  var redisClient = redis.createClient();

  redisClient.subscribe('RealTimeChannel');


  redisClient.on("message", function(channel, message) {
      
      var data=JSON.parse(message)

        console.log(data.channel_type,data.user_two_id)
         
         socket.emit(channel+'_'+data.channel_type+'_'+data.user_two_id,data);
         socket.emit(channel+'_'+data.channel_type+'_'+data.user_one_id,data);
        

         socket.emit(channel+'_'+data.channel_type,data);
       

         //socket.emit('start_challenge_view',data);
 



  });




/* //TO BE DONE LATER

 socket.on('challenge_start',function(data){

  
      socket.emit('challenge_start_'+data.user_one_id,data);
      socket.emit('challenge_start_'+data.user_two_id,data);
     
});


*/



socket.on('disconnect',function(){

  console.log('User disconnected')
    redisClient.quit();
   });





});
 