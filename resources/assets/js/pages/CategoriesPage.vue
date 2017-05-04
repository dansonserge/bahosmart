<script>
import {mapState} from 'Vuex';

import {loginRoute, getHeader, userRoute,userCatsRoute} from '../config.js';

import {clientId, clientSecret } from '../.env.js';

export default{
	computed:{

		  ...mapState({
        userStore: state => state.userStore
       })
    },


	mounted:function(){

 this.$store.dispatch('setCategoryLength',1000);



  },
  methods:{
    addCategory:function(category){
       
       this.$store.dispatch('followCategory',category)

     }
	}

}
</script>

<template>
<div class="content_wrapper">

<div class="categories-selection col-md-12">
      
      <div class="col-xs-12">
     
      <div class="row continue">
     <router-link :to="{name:'discover'}">       
  <a v-show="followed_categories != 0" class="btn btn-primary find_ppl_to_follow" >
     Continue
    <i class="fa fa-arrow-right" aria-hidden="true"></i>
  </a>
  </router-link>
 
          <div class="col-xs-4"></div>
      </div>

<div class="row">
          

          <discovering>
          </discovering>

      </div>
 

      
      <div class="row">

      
  <div class="category col-md-3 col-sm-6 col-xs-12" v-for="category in userStore.userCategories">
        <div class="category_cell">
              
               <!--change the look of the category if the user follow it or not-->
               <div class="category-name">
             	 <div class="col-xs-10" @click="addCategory(category)">
             	      {{category.name}}
             	 </div>
             	 <div class="col-xs-2">
             	    <i :class="{'fa fa-check-circle':category.followed, 
                  'fa fa-plus-circle':!category.followed}" 
                  aria-hidden="true"></i>
             	</div>
             </div> 
          </div>
          
  </div>
         
        
      </div>
      
   
   </div>
  </div>






	
</div>
</template>

<style>
</style>