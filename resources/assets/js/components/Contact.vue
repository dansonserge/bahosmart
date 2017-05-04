<script>

import {mapState} from 'Vuex';
export default{
  computed:{
       ...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.initDataStore
       })
   },
   data:function(){
      return {
        
      }
    },
    mounted(){

      
    },
    methods:{
      getUser:function(user){

     window.localStorage.setItem('setUserInfo',JSON.stringify(user));

         this.$store.dispatch('setUserInfo',user)

         this.$router.push({name:'user_info'})
      }
    }

}
</script>

<template>
  <div>
    <div class="list-group col-md-xs">
     <a class="list-group-item" v-for="user in userStore.userFollowers" @click="getUser(user)">
         <img :src="user.profile_pic" class="img-circle" height="50">
            <span class="card-user-names">{{user.first_name}}  {{user.last_name}}</span>
          <i class="fa fa-caret-right pull-right card-menu-list" aria-hidden="true"></i>
     </a>
  </div>
</div>
</template>

<style>
</style>