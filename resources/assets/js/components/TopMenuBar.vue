<script>
   
   import {mapState} from 'Vuex'




    export default {

     computed:{

            ...mapState({
        userStore: state => state.userStore
       })

          
            },
           mounted:function(){

          
      this.$store.dispatch('runSockets')
     
 



  
             
              const authUser=JSON.parse(window.localStorage.getItem('authUser'))
              const userCategories=JSON.parse(window.localStorage.getItem('userCategories'))
           
                   
                   this.$store.dispatch('setUserObject',authUser)
                   this.$store.dispatch('setUserCategories',userCategories)
                  
         
},   
       methods:{

    closeGuider:function(){
      this.$store.dispatch('setCategoryLength',1000)
    }
    

  },

 data:function(){
             return {
          categories:[
              {name: 'tech',icon:'fa-mobile fa-lg', link:'technology',notification:2,id:1},
              {name:'Music',icon:'fa-music', link:'music',notification:0,id:2},
              {name:'Movies',icon:'fa-film', link:'movies',notification:2,id:3},
              {name:'Fashion',icon:'', link:'fashion',notification:2,id:4},
              {name:'Sport',icon:'fa-futbol-o', link:'sport',notification:2,id:5},
              {name:'Art',icon:'fa-paint-brush', link:'art',notification:5,id:6},
           ]
        }
      }
    }
</script>

<template>
<div>
    
<div v-if="userStore.authUser !== null && userStore.authUser.access_token" >
<nav class="navbar navbar-default navbar-fixed-top top-top" role="navigation">
    <div class="container">
        <!-- logo -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle front_nav_btn" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <router-link :to="{name:'about'}" class="navbar-brand">
            Bahosmart
            </router-link>
                            
        </div>
        <!-- menu -->
        <div class="collapse navbar-collapse navbar-static-top" id="navbar1">
        
         <ul class="nav navbar-nav" id="ul">
            <li v-for="category in categories">
             <a>
              <i class="fa" :class="[category.icon]"></i> {{category.name}}
                 <span v-show="category.notification != 0" class="label label-danger label-as-badge">
                  {{category.notification}}</span>
              </a>
             </li>
        </ul> 
         
       <form method="get" action="" id="search" class="pull-right">
             <input 
                Placeholder="Search" 
                onfocus="this.value = '';" 
                require="" 
                size="40"
                onblur="if (this.value == '') {this.value = 'Search...';}" 
                name="keyword"
                 type="text">
                <button class="hidden" name="Search"></button>
        </form>
    </div>
</div>
   
</nav>
 <div class="user_guider" v-if="userStore.categoryLength === 0">
    
<div class="guider_content">
<div>
  <a class="close-guide btn btn-danger" @click="closeGuider()"><i class="fa fa-close"></i></a>
</div>
<div>

 
   <h4><strong>Let's help you!</strong></h4>
    <ol>
        <li>
    <strong>

    <router-link :to="{name:'categories'}">

    <a href="#">click here to Follow your interests</a>
    </router-link>
    </strong>
            
        </li>
   
    </ol>
</div>
  


</div>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-top" v-if="userStore.authUser === null" role="navigation">
    <div class="container">
        <!-- logo -->
    <div class="navbar-header">
    
      <button type="button" class="navbar-toggle front_nav_btn" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
      </button>
            <a class="navbar-brand" href="#">BahoSmart</a>
        </div>
        <!-- menu -->
        <div class="collapse navbar-collapse navbar-static-top" id="navbar1">
            
          <ul class="nav navbar-nav" id="ul">
       
          </ul> 
          <form method="get" action="" id="search" class="pull-right">
            <input 
                Placeholder="Search" 
                onfocus="this.value = '';" 
                require="" 
                size="40"
                onblur="if (this.value == '') {this.value = 'Search...';}" 
                name="keyword"
                 type="text" 
                >
                <button class="hidden" name="Search"></button>
            
        </form>
        </div>
    </div>
    
</nav>
</div>
</template>
<style >
.navbar-fixed-top{
  z-index: 1050;
}
 .user_guider{


 position: absolute;
 z-index: 1060;

 background-color: #ccc;
 border-radius: 10px;

padding:5px 10px 5px 10px;


margin-left: 200px;




opacity: 0.98;
}


.close-guide{
    position:absolute;
      right: 1em;
      cursor: pointer;

 
}


</style>
