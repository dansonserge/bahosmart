 import io from 'socket.io-client';


import {likePostRoute,getHeader,followCategoryRoute} from '../../config.js';

import {clientId, clientSecret } from '../../.env.js';


import store from '../../store'
import router from '../../router'


 const socket=io('http://192.168.10.10:8890');

//STATES
const state= {
 authUser:null,
 userCategories:null,
 categoryLength:0,
 usersToFollow:null,
 singlePost:null,
 allFeeds:null,
 messages:null,
 userFollowers:null,
 current_user:null,
 challenges:[],
 current_challenge_view:[],
 current_challenge_call:null,
 challenge:null,
 questions_answers_selected:[]
}





//MUTATIONS
const mutations={

	SET_AUTH_USER (state,userObj){

		state.authUser=userObj
     },
	CLEAR_AUTH_USER(state){
        state.authUser=null
	},
	SET_USER_CATEGORIES(state,userCatObj){
		state.userCategories=userCatObj
	},
	CLEAR_USER_CATEGORIES(state){
		state.userCategories=null
	},
	SET_CATEGORY_LENGTH(state,catLength){
		state.categoryLength=catLength
	},
	CLEAR_CATEGORY_LENGTH(state){
        state.categoryLength=0
	},
	FOLLOW_CATEGORY(state,{category,response}){

		category.followed=response.body.followed
    },
	SET_USERS_TO_FOLLOW(state,usersObject){
		state.usersToFollow=usersObject
	},
	CLEAR_USERS_TO_FOLLOW(state){
		state.usersToFollow=null
	},
	CLEAR_USER__FOLLOWERS(state){
		state.userFollowers=null
	},

	SET_SINGLE_POST(state,post_id){

     state.singlePost=post_id
    },
  SET_POSTS(state,allFeeds){
    	state.allFeeds=allFeeds
    },
    CLEAR_POSTS(state){
      state.allFeeds=null
    },
     LIKE_POST(state,{post,response}){

     	console.log(response)

       if(response.body.like_msg){
         

       }
       	else{}

   },
   SET_USER_FOLLOWERS(state,userObj){
    	state.userFollowers=userObj
    },
    SET_USER_INFO(state,user){

    	state.current_user=user
    },
    RUN_SOCKETS(){
      setTimeout(()=>{
          let id=state.authUser.userobject.id
    	    console.log('hello man')
   


           socket.on('RealTimeChannel_challenge_view_'+id,function (message) {
                
                  console.log('Challenge now!!!!',{'challenge':message})
            
                 store.dispatch('goChallenge',message)

            }); 


           socket.on('RealTimeChannel_challenge_start_view_'+id,function (message) {
                
                 // console.log('start challenge woow!!!',{'challenge':message})
            
                 store.dispatch('changeChallengeCall',message)

            });

    	      
            //ADD CHALLENGE
          socket.on('RealTimeChannel_challenge_request_'+id,function (message) {
      	  
      	          console.log('QuizYYY ',{'challenge':message})

      		        store.dispatch('addChallenge',message)
        
          });

     },1)
},
   ADD_CHALLENGE(state,payload){

    state.challenges.push(payload);
    console.log(state.challenges)
   },
   
   SET_CURRENT_CHALLENGE_VIEW(state,payload){
    state.current_challenge_view=payload
    },

    START_CHALLENGE(){
       
console.log('yoo man 2')
            
            setTimeout(()=>{
                     
                   let id=state.authUser.userobject.id
                     
                    socket.on('challenge_start_'+id,function (message) {
                
                    console.log('start challenge woow!!!',{'challenge':message})

                   });
            },1)
   },
   CHALLENGE_CALL(state,payload){
      
      state.current_challenge_call=payload;
      console.log('lets get it')

      router.push({name:'challenge_start_page'})

   },
   GO_CHALLENGE(state,payload){
    state.challenge=payload
    router.push({name:'challenge_playground'})

   }
}

//ACTIONS
const actions= {
    setUserObject: ({commit},userObj) => {
		commit('SET_AUTH_USER',userObj)
	},
	clearAuthUser:({commit})=>{ 
		commit('CLEAR_AUTH_USER')
	},
	setUserCategories:({commit},userCatObj)=>{
		commit('SET_USER_CATEGORIES',userCatObj)
	},
	clearUserCategories:({commit})=>{
		commit('CLEAR_USER_CATEGORIES')
	},
	setCategoryLength:({commit},catLength)=>{
	     commit('SET_CATEGORY_LENGTH',catLength)
	},
	clearCategoryLength:({commit})=>{
		commit('CLEAR_CATEGORY_LENGTH')
	},
	followCategory:({commit},category)=>{

       let pData={
        "category_id":category.id,
        "user_id":state.authUser.userobject.id
       }


       return Vue.http.post(followCategoryRoute,pData).then((response)=>{
                
                commit('FOLLOW_CATEGORY',{category,response})
                
			    console.log(response.body)

		},(response)=>{

            commit('FOLLOW_CATEGORY',{category,response})
			console.log("bad thing is happening")
		})
	  },
     
     setUsersToFollow:({commit},usersObject)=>{
	  	
	  	commit('SET_USERS_TO_FOLLOW',usersObject)
	  
	  },

	clearUsersToFollow:({commit})=>{
	  	
	  	commit('CLEAR_USERS_TO_FOLLOW')
	  },
	
	setSinglePost:({commit},post_id)=>{
      commit('SET_SINGLE_POST',post_id)
       },
    setPosts:({commit},allFeeds)=>{

         commit("SET_POSTS",allFeeds)
    },
    clearPosts:({commit})=>{
        commit("CLEAR_POSTS")
      },
    likePost:({commit},post)=>{
         let pData={
         "post_id":post.id,
         "user_id":state.authUser.userobject.id
       }

       return Vue.http.post(likePostRoute,pData).then((response)=>{
                commit('LIKE_POST',{post,response})
                console.log(response.body.like_msg)
    
    },(response)=>{

			console.log("bad thing is happening")

		})
	  },
     setUserFollowers:({commit},userObj) => {
       commit('SET_USER_FOLLOWERS',userObj)
      },
  	clearUserFollowers:({commit}) => {
  		commit('CLEAR_USER__FOLLOWERS')
  	},

    setUserInfo:({commit},user) => {
         commit('SET_USER_INFO',user)
      },  


    runSockets:({commit}) =>{
    	commit('RUN_SOCKETS')
    },
    addChallenge:({commit},payload)=>{
    	commit('ADD_CHALLENGE',payload)


    },
    setCurrentChallengeView:({commit},payload)=>{
    	commit('SET_CURRENT_CHALLENGE_VIEW',payload)
    },

    startChallenge:({commit})=>{

      commit('START_CHALLENGE')

    },

    changeChallengeCall:({commit},payload)=>{
     
      commit('CHALLENGE_CALL',payload)

    },
    goChallenge:({commit},payload)=>{

     commit('GO_CHALLENGE',payload)

    },
    addSelectedAnswers:({commit},payload)=>{
      commit({commit},payload)
    }


}


//GETTERS
const getters={
	/*getUser: (state, getters) => (id) => {
    return state.userFollowers.find(user => user.id === id)
  },*/

  get_my_id: state => state.authUser.userobject.id

}


export default {
 state, mutations, actions, getters
}