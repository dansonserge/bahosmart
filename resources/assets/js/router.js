

import Vue from 'vue'

import VueRouter from 'vue-router';

    Vue.use(VueRouter)

//import pages components
    
    import FeedsPage from './pages/FeedsPage.vue';
       
    import WelcomePage from './pages/WelcomePage.vue';
    
    import MainPage from './pages/MainPage.vue';
   
    import DiscoverPage from './pages/DiscoverPage.vue';
      
    import ReportsPage from './pages/ReportsPage.vue';
    
    import PostsPage from './pages/PostsPage.vue';
    
    import NotificationsPage from './pages/NotificationsPage.vue';

    import ProfilePage from './pages/ProfilePage.vue';

    import CategoriesPage from './pages/CategoriesPage.vue';

    import UsersPage from './pages/UsersPage.vue';
    
    import SinglePost from './pages/SinglePost.vue';

    import NewPost from './pages/NewPost.vue';

    import SocketTest from './pages/SocketTest.vue';

    import AboutPage from './pages/AboutPage.vue';
    
    import UserInfo from './pages/UserInfo.vue';

    import ChallengePage from './pages/ChallengePage.vue';

    import ChallengeStartPage from './pages/ChallengeStartPage.vue';

    import ChallengePlayground from './pages/ChallengePlayground.vue';


 
    //routes
const routes=
[
    {path:'/', component:WelcomePage, name:'home'},

    {path:'/welcome', component: WelcomePage, name:'welcome'},
    
    {path:'/about', component: AboutPage, name:'about', meta: { requiresAuth: true }},
    
    {path:'/feeds', component: FeedsPage, name:'feeds', meta: { requiresAuth: true }},
    
    {path:'/main', component: MainPage, name:'main', meta: { requiresAuth: true }},

    {path:'/discover', component: DiscoverPage, name:'discover', meta: { requiresAuth: true }},
     
    {path:'/reports', component: ReportsPage, name:'reports', meta: { requiresAuth: true }},
    
    {path:'/posts', component: PostsPage, name:'posts', meta: { requiresAuth: true }},
    
    {path:'/new_post', component: NewPost, name:'new_post', meta: { requiresAuth: true }},
    
    {path:'/notifications', component: NotificationsPage, name:'notifications', meta: { requiresAuth: true }},
    
    {path:'/profile', component: ProfilePage, name:'profile', meta: { requiresAuth: true }},
    
    {path:'/categories', component: CategoriesPage, name:'categories', meta: { requiresAuth: true }},
   
    {path:'/users', component: UsersPage, name:'users', meta: { requiresAuth: true }},
    
    {path:'/single_post',name:'single_post',props:true ,component: SinglePost, meta:{ requiresAuth: true }},

    {path:'/socket_test', component: SocketTest, name:'socket_test', meta: { requiresAuth: true }},
   
    {path:'/user_info', component: UserInfo, name:'user_info', meta: { requiresAuth: true }},

    {path:'/challenge', component: ChallengePage, name:'challenge', meta: { requiresAuth: true }},
    
    {path:'/challenge_start_page', component: ChallengeStartPage, name:'challenge_start_page', meta: { requiresAuth: true }},
   
    {path:'/challenge_playground', component: ChallengePlayground, name:'challenge_playground', meta: { requiresAuth: true }}

];



const router=new VueRouter({
	mode:'history',
	routes

})

router.beforeEach((to, from, next) => {

if(to.meta.requiresAuth){

	const authUser=JSON.parse(window.localStorage.getItem('authUser'));

	  if(authUser && authUser.access_token){

         next()
      }
	  else{
       next({name:'welcome'})
	   }
     }
  next()
})

export default router





