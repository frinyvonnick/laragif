import Application from './components/Application.vue'
import SearchBar from './components/SearchBar.vue'
import Echo from 'laravel-echo'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 window.Echo = new Echo({
     broadcaster: 'socket.io',
     host: window.echoServer
 });

new Vue({ // eslint-disable-line no-new
  el: '#app',
  components: { Application, SearchBar },
})
