/*var container = document.querySelector('#all-cards');
  var masonry = new Masonry(container, {
    columnWidth: '.my-card',
    itemSelector: '.my-card'
  });
*/
var $grid = $('#all-cards').masonry({
  itemSelector: '.my-card',
  
  columnWidth: '.my-card'
});
// layout Isotope after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry();
}); 

$(function(){

  //toggle navs

  $('.front_nav_btn').click(
     function(){
      $('.nav-chat').toggle();

     });
	//mykgl post pic upload

  
$("input[type='file']").hide();
  $('.upload-pic').click(function(){

  $("input[type='file']").trigger('click');
  });

    



$('input[type="file"]').on('change', function() {
  var val = $(this).val();
  $(this).siblings('span').text(val);
})

   //mykgl single post option menu



$('.news-opt-menu').hide();
$(document).click(function(e){
	var target= e.target;
	if(!$(target).is('.news-opt') && !$(target).parents().is('.news-opt')){
	$('.news-opt-menu').hide();
	}
});
//show



  $( '.news-opt' ).click(function() {
     var index = $( ".news-opt" ).index( this );
      $('.news-opt-menu').eq(index).toggle();
   });



   

// submit button



$('.submit-post').click(function(){

	$(".uploadbtndefault").trigger('click');
});
//edit post
var postId=0;
var postTitleEl= null;
var postTextEl=null;
$('.edit_post').click(function(e){
e.preventDefault();
    postTitleEl=e.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1].childNodes[1];
var postTitle= postTitleEl.textContent;

           postTitle=$.trim(postTitle);

  $('#post_model_title').val(postTitle);

      postTextEl=e.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1].childNodes[7]
  var postText= postTextEl.textContent;
           postText=$.trim(postText);
           postId= e.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
  $('#post_model_text').val(postText);
$('#edit_post_model').modal();
});

$('#modal-save').click(function(){
$.ajax({
  method:'POST',
  url:urlEdit,
  data:{ post_text:$('#post_model_text').val(), postId:postId, post_title: $('#post_model_title').val(),_token:_token }
}).done(function(msg){
  $(postTitleEl).text(msg['new_title']);
  $(postTextEl).text(msg['new_text']);
  $('#edit_post_model').modal('hide');
});
});

$(document).on('click','.follow-btn',function(e){
  e.preventDefault();
  var userid=$(this).attr('data-userid');
  var followsuserid=$(this).attr('data-followsuserid');


  $.ajax({
    method:'POST',
    url:follow_url,
    data:{userid:userid,followsuserid:followsuserid,_token:_token }
  }).done(function(msg){
    console.log(msg['follow_msg']);
     if(msg['newClass']=='addfollowEffect'){
        $('.follow_'+followsuserid).empty();
         var html='FOLLOWING <i class="fa fa-check-circle" aria-hidden="true"></i>';
        $('.follow_'+followsuserid).append(html);
    $('.follow_'+followsuserid).addClass('addfollowEffect');
        
     }
     else{
        $('.follow_'+followsuserid).empty();
         var html='FOLLOW';
         $('.follow_'+followsuserid).append(html);
        $('.follow_'+followsuserid).removeClass('addfollowEffect');
     }
  });
});

$(document).on('click','.like',function(e){
  e.preventDefault();

  var userid=$(this).attr('data-userid');
  var postid=$(this).attr('data-postid');
  
  $.ajax({
 method:'POST',
    url:urlLike,
    data:{userid:userid,postid:postid,_token:_token}
}).done(function(msg){
 
console.log(msg['like_msg']);


if(msg['like_msg']=='You unlike the post'){
$('.like_'+postid).removeClass('likey');

$('.like_'+postid).removeClass('w3-border-red');
$('.like_'+postid).addClass('w3-border-teal');
}
else if(msg['like_msg']=='You like the post'){
  $('.like_'+postid).addClass('likey');
  $('.like_'+postid).removeClass('w3-border-teal');
  $('.like_'+postid).addClass('w3-border-red');
}
   });
  });
});

//...........................................................................................................
//Variables
//........................................................................................  

$('.goto_chats').click(function(e){
  e.preventDefault();
  var userid=$(this).attr('data-userid');

$.ajax({
    method:'POST',
    url:chats_url,
    data:{
      userid:userid, _token:_token},



  }).done(function(msg){

    var newView=msg['html'];

    $('footer').remove();
     $('.contents').html(newView);
    $(this).removeClass('addfollowEffect');

   });
});



$(document).on('click','.one_chat',function(e){
  e.preventDefault();

var userid=$(this).attr('data-userid');
    

$.ajax({
    method:'POST',
    url:chat_url,
    data:{userid:userid }

  }).done(function(msg){

    var pic=msg['profile_picture'];
    var f_name=msg['first_name'];
    var l_name=msg['last_name'];
    var newView=msg['html'];

    $('.contents').html(newView);
   

  });

         

});

/*Game packs menu*/
$('.game-packs').hide();

$(document).click(function(e){
  var target= e.target;
  if(!$(target).is('.letsplay') && !$(target).parents().is('.letsplay')){
  $('.game-packs').hide();
  }
});

    //show Game packs menu
 
$(document).on('click','.letsplay',function(e){
    var index = $( ".letsplay" ).index(this);
    
    $('.game-packs').eq(index).toggle();


});



$(document).on('click','.low-pack',function(e){
  $('.level-note').html('You chose the first level quiz');

  $('.level').remove();
   
  $('.allowform').append('<input type="hidden" name="level" value="1" id="level" class="level">');
  $('#wallet-allow').modal();

  });

$(document).on('click','.medium-pack',function(e){
  $('.level-note').html('You chose the second level quiz');

  $('.level').remove();

  $('.allowform').append('<input type="hidden" name="level" value="2" id="level" class="level">');
  
  $('#wallet-allow').modal();


  });

$(document).on('click','.advanced-pack',function(e){

   
  $('.level-note').html('You chose the third level quiz');
  $('.level').remove();

  $('.allowform').append('<input type="hidden" name="level" value="3" id="level" class="level">');

  


  $('#wallet-allow').modal();
  });



$(document).on('click','#allow_wallet_btn',function(e){
    var opponentid=$('#allow_wallet_btn').attr('data-opponentid');
 
  

$.ajax({
  method:'POST',
  url:wlt,
  data:{ post_username:$('#username').val(), post_pwd:$('#pwd').val(), post_token:$('#token').val(),post_level:$('#level').val(),post_opponentid:opponentid}
}).done(function(msg){
  if(msg['failure']==1){
    console.log('wrong user :-(');
  $('.wlt-login-failed').remove();

  $('.msg-place').append('<div class="alert alert-danger wlt-login-failed">Please, double check your Username and Password</div>');
     }
     else if(msg['failure']==0 && msg['success']==1){
      console.log(msg['wallet_token']);
      var newView=msg['html'];

       $('#wallet-allow').modal('hide');
  $('#wallet-allow').on('hidden.bs.modal',function(){

     $('.contents').html(newView);
  });
     // $('.contents').remove();
    }
  });
});

$(document).on('click','#signup-submit',function(e){
  var first_name,last_name,email,password,password_confirmation,form_token;
  first_name= $('#first_name').val();
  last_name=$('#last_name').val();
  email=$('#email').val();
  password=$('#password').val();
  password_confirmation=$('#password_confirmation').val();
  form_token=$('#form_token').val();


$.ajax({
  method:'POST',
  dataType:'json',
  url:sgnp,
  data:{ first_name:first_name, last_name:last_name, email:email,password:password,password_confirmation:password_confirmation,_token:_token}
}).done(function(msg){
    
if(msg['failure']==1){

  var errors='';
  var x;
     for(x in msg[0]){

       errors+='<li>'+msg[0][x]+'</li>';
     }
     
     var error_div='<div class="alert alert-danger"> <div class="col-md-1 su-errors-close pull-right"><i class="fa fa-close"></i></div><ol>';
     var error_div_close='</ol></div>';
     $('.signup-errors').hide().html(error_div+=errors+=error_div_close).fadeIn();
     
   }


else if(msg['failure']==0 && msg['success']==1){

      var newView=msg['html'];

      console.log(newView);

      $('.contents').html(newView);
      
       
}



});


});

var signupwindow = '<div class="signup"><button class="btn btn-primary btn-block"><i class="fa fa-facebook-square fa-lg"></i> Log In with Facebook</button><h4><span>OR</span></h4><div class="signup-div"><div class="signup-errors"></div><input type="hidden" value="_token()"><div class="form-group"><input type="text" name=first_name" id="first_name" class="form-control" placeholder="First Name"></div><div class="form-group"><input type="text" name=last_name" id="last_name" class="form-control" placeholder="Last Name"></div><div class="form-group"></div><div class="form-group"><input type="text" name=email" id="email" class="form-control" placeholder="Email"></div><div class="form-group"></div><div class="form-group"><input type="password" name=password" id="password" class="form-control" placeholder="Password"></div><div class="form-group"></div><div class="form-group"><input type="password" name=password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm the password"></div><div class="form-group"></div><input type="submit" class="btn btn-primary btn-block" id="signup-submit"> <p>By signing up, you agree to our<br> <b> Terms & Privacy Policy.</b></p></div></div><div class="signin"><p>Have an account? <a class="login_btn">Log in</a> </p></div>';
var signinwindow = '<div class="signup"><button class="btn btn-primary btn-block"><i class="fa fa-facebook-square fa-lg"></i> Log In with Facebook</button><h4><span>OR</span></h4><div class="sign_or_log"><div class="signin-errors"></div><div class="login"><div class="form-group input-group"><span class="input-group-addon"><i class="fa fa-user"></i> </span><input type="hidden" name="_token" id="login_token" value="{{csrf_token()}}"><input type="email" id="user_email"name="email" placeholder="Email" class="form-control"></div><div class="form-group input-group"><span class="input-group-addon"><i class="fa fa-lock"></i> </span><input type="password" id="user_pwd"name="password" class="form-control" placeholder="Password"></div><input type="submit" class="btn btn-primary btn-block " id="signin-submit"><p><a href="#">Forgot password?</a></p></div></div></div><div class="signin"><p>Don\'t have an account? <a class="signup_btn">Sign up</a> </p></div>';

$(document).on('click','.login_btn',function(e){
    
$('.user-auth').html(signinwindow);
});

$(document).on('click','.signup_btn',function(e){
    

     $('.user-auth').html(signupwindow);

});


$(document).on('click','#signin-submit',function(e){
  var email,password;
  email= $('#user_email').val();
  password=$('#user_pwd').val();

  

$.ajax({
  method:'POST',
  dataType:'json',
  url:sgnn,
  data:{ email:email, password:password, _token:_token}
}).done(function(msg){


    
if(msg['failure']==1){

     var text='<li>'+msg['message']+'<div class="col-md-1 pull-right si-errors-close"><i class="fa fa-close "></i></div></li>';
     
     var error_div='<div class="alert alert-danger"> <ul>';
     var error_div_close='</ul></div>';

     $('.signin-errors').hide().html(error_div+=text+=error_div_close).fadeIn();
  
   }


else if(msg['failure']==0 && msg['success']==1){
  
      var newView=msg['html'];
      var account_info='<span class="user_name"><a href="http://localhost/bahosmart/public/profile/index">'+msg['first_name']+'&nbsp'+msg['last_name']+'</a></span>';
       $('.account-info').html(account_info);
       $('.contents').html(newView);
      }
   });
});

$(document).on('click','.si-errors-close',function(e){
     
$('.signin-errors').empty();


});

$(document).on('click','.su-errors-close',function(e){
     
$('.signup-errors').empty();


});

$('.category_cell_hovered').hide();

$(document).on('mouseenter','.category', function (e) {

  
  var catid=e.target.parentNode.dataset['catid'];
           var innerHtml= $.trim($('.category-status-'+catid).html());
       
console.log(innerHtml);

  if(innerHtml=='<i class="fa fa-plus-circle" aria-hidden="true"></i>'){
      
    $(this).find('.category_cell_hovered').append('<i class="fa fa-check-circle" aria-hidden="true"></i>');


  }
  else if(innerHtml=='<i class="fa fa-minus-circle" aria-hidden="true"></i>'){
    $(this).find('.category_cell_hovered').append('<i class="fa fa-times-circle" aria-hidden="true"></i>');

  }
  



}).on('mouseleave','.category',  function(){

    $(this).find('.category_cell_hovered').html('');

    });


$(document).on('click','.category',function(e){
  
  var userid=$(this).attr('data-userid');
  var catid=$(this).attr('data-catid');

  $('category_cell_hovered').html('<i class="fa fa-check-circle" aria-hidden="true"></i>');

  console.log('category id is '+catid+', user id is '+userid);
  
  $.ajax({
 method:'POST',
    url:flwcat,
    data:{user_id:userid,category_id:catid,_token:_token}
}).done(function(msg){
 
console.log(msg['category_msg']);


if(msg['category_msg']=='You unfollow the category'){
  
$('.category-status-'+catid).html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
}
else if(msg['category_msg']=='You follow the category'){

$('.category-status-'+catid).html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
  
}
   });
  });

$(document).on('click','.find_ppl_to_follow',function(e){
  
  var userid=$(this).attr('data-userid');
  
  $.ajax({
 method:'POST',
    url:tobeflwd,
    data:{user_id:userid,_token:_token}
}).done(function(msg){
     var newView=msg['html'];

    $('.contents').html(newView);
    
    console.log(msg['samples']);

   });
  });


$(document).on('click','.home_index',function(e){
      e.preventDefault();
      console.log('you clicked to go on home_index');
       var userid=$(this).attr('data-userid');
      $.ajax({
         method:'POST',
         url:home_index,
         data:{user_id:userid,_token:_token}
         }).done(function(msg){
          var newView=msg['html'];
          $('.contents').html(newView);

          console.log(msg['samples']);
         });

 });





