<script>
export default{
     
     data:function(){
        return {
        	editMenuShow:false
        }



     },
     methods:{
        ToggleEditMenu:function(event){
            if(this.editMenuShow==false){
            	this.editMenuShow=true
            }

            else{
            	this.editMenuShow=false
            }
        }
     }
  }

   
</script>
<template>
<div class="col-xs-2 post_title news-opt"><span class="glyphicon glyphicon-option-vertical" v-on:click="ToggleEditMenu"></span> 
                  
                    <ul class="news-opt-menu w3-card-2 " v-if="editMenuShow">
                      <li><a href="#" class="edit_post">Edit</a> <span class="glyphicon glyphicon-pencil"></span></li>
                      <li><a href="#" class="delete_post">Delete</a><span class="glyphicon glyphicon-trash"></span></li>
                   </ul>
            </div>
</template>
<style>

 
	

</style>