<script>


export default{

}
</script>

<template>


<nav class="navbar-default navbar-fixed-bottom nav-chat">
  <div id="navbar2">
    <ul class="nav navbar-nav col-xs-12 bottom-nav">
	   <li class="col-xs-2">
	       <router-link :to="{name:'main'}">
	         <a>
	            <i class="fa fa-home fa-lg bottom-icons" aria-hidden="true">
	            </i>
	         </a>
	        </router-link> 
	    </li>
	    
	    <li class="col-xs-2">
	        <router-link :to="{name:'discover'}">
	            <a>
	              <i class="fa fa-user-plus fa-lg bottom-icons" aria-hidden="true">
	              </i>
	            </a>
	        </router-link>
	    </li>
	    
	    <li class="col-xs-2">
	     <router-link :to="{name:'reports'}">
	        <a>
	          <i class="fa fa-line-chart fa-lg bottom-icons" aria-hidden="true">
	          </i>
	        </a>
	        </router-link>
	    </li>
        
	    <li class="col-xs-2">
	     <router-link :to="{name:'posts'}">
	       <a>
	         <i class="fa fa-pencil-square-o fa-lg bottom-icons" aria-hidden="true">
	         </i>
	       </a>
	       </router-link>
	    </li>

	    <li class="col-xs-2">
	      <router-link :to="{name:'notifications'}">
	       <a> 
	          <i class="fa fa-globe fa-lg bottom-icons" aria-hidden="true">
	          </i>
	        </a>
	    </li>
	    <li class="col-xs-2">
	       <router-link :to="{name:'profile'}">
	          <a>
	            <i class="fa fa-user fa-lg bottom-icons" aria-hidden="true">
	            </i>
	          </a>
	       </router-link>
	    </li>
       </ul>
	</div>
  </nav>
 </template>
<style>

.navbar-default .navbar-nav > li > a:hover{
	border:0px;
}
.bottom-icons{
	color:#ecf0f1;
}

 .col-xs-2{
	padding-left:0px;
}





</style>