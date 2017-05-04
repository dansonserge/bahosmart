<script>
  
   import {mapState,mapGetters} from 'Vuex'

   

   import {loginRoute,getHeader,userRoute,userCatsRoute,categoriesRoute,initialData} from './config.js';
   
   import {clientId, clientSecret } from './.env.js';
	
    Vue.component('top-menu-bar', require('./components/TopMenuBar.vue'));

  export default{
    computed:{
    	...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.initDataStore
       }),

      ...mapGetters(
        ['get_my_id']
      )
   },

	mounted:function (){

    console.log('working now')

     this.initialDataLoader()
        
},
data:
  function(){
  return {
    
  };
},
     methods:{
        initialDataLoader:function(){
              const initData={}

               this.$http.get(initialData).then((response) => {
                   console.log(response.data.categories)

                  initData.packs=response.data.packs;
                  initData.categories=response.data.categories;

                window.localStorage.setItem('initData',JSON.stringify(initData));

                this.$store.dispatch('setInitialData',initData);
                
                   }, (response) => {
                  console.log('Things went wrong')
                  });
                },

     	handleLogout:function(){
        window.localStorage.removeItem('authUser')
     		this.$store.dispatch('clearAuthUser')

       

        window.localStorage.removeItem('userCategories')
        
        window.localStorage.removeItem('categoryLength')

       
       
        window.localStorage.removeItem('setUserInfo')
     

        

        this.$store.dispatch('clearUserCategories')

        this.$store.dispatch('clearCategoryLength')

        this.$store.dispatch('clearUserFollowers')


        this.$store.dispatch('clearUsersToFollow')
         
     		this.$router.push({name: 'home'})
     	}
     }

}
</script>


<template>
<div>
<top-menu-bar></top-menu-bar>

<div class="contents">
  <router-view>
	</router-view>


     <a @click="handleLogout()">Logout</a>
     
     {{this.user}}
  </div>
    <bottom-nav-bar v-if="userStore.authUser !== null && userStore.authUser.access_token">
    </bottom-nav-bar>
   </div>
</template>
<style>

</style>