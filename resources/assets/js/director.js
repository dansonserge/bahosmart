require('./bootstrap');
/*require('./main');

require('./imageLoaded');

require('./masonry');

*/

    import router from './router'
    import store from './store'

//Vue components
	Vue.component('app', require('./App.vue'));
	Vue.component('intro-div',require('./components/IntroDiv.vue'));
    Vue.component('bottom-nav-bar',require('./components/BottomNavBar.vue'));
   
    Vue.component('chat', require('./components/Chat.vue'));
    Vue.component('challenge', require('./components/Challenge.vue'));
    Vue.component('contact', require('./components/Contact.vue'));
    Vue.component('post-editor', require('./components/PostEditor.vue'));

    Vue.component('discovering', require('./components/Discovering.vue'));

    Vue.component('feeds', require('./components/Feeds.vue'));


new Vue({

router,
store

}).$mount('#app')




