<script>
	import {mapState} from 'Vuex'

import { getHeader,followUsersRoute,followUserRoute} from '../config.js';

import {clientId, clientSecret } from '../.env.js';

export default{
   computed:{

            ...mapState({
        userStore: state => state.userStore
           })


       },
       data:function(){
         return {
           //user_type
         }
       	
       },
	   mounted:function(){
       
        },
       methods:{
      
      }
}
</script>
<template>
	
	<div>
       
       <h1>
        
       </h1>
      
    </div>




	</div>


</template>
<style></style>