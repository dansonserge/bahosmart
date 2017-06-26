<script>

import {mapState} from 'Vuex'
  

   import io from 'socket.io-client';

   const socket=io('http://192.168.10.10:8890');

  
export default{
    computed:{



   ...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.userStore
       }),
      
   },

   data(){

    return {

      'testing_pic':'',
      'testing_id':'',
      
    }

   },
   mounted(){
      this.testing_id=this.userStore.authUser.userobject.id
      this.testing_pic=this.userStore.authUser.userobject.profile_picture
      console.log(this.testing_id)
      console.log('your pic is: ',this.testing_pic)
   },

   methods:{
     getChat:function(){
       console.log('we are getting a user!')

        this.$router.push({name:'chats'})
     }
 }
}

</script>

<template>
  <div>
     <div class="list-group col-md-xs">
       <a class="list-group-item" v-on:click="getChat()">
           <img :src="testing_pic" class="img-circle" height="50">
              <span class="card-user-names">Joe Doe</span>
            <i class="fa fa-caret-right pull-right card-menu-list" aria-hidden="true"></i>
       </a>
     </div>

</div>
         
</template>

<style>
</style>