import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import './assets/main.css'
import Vue from 'vue'

Vue.prototype.$baseUrl = 'myurl.com'

// App.vue

export default {
    created() {
        console.log(this.$baseUrl) // logs 'myurl.com'
    }
}
// createApp(App).mount('#app')
const app = createApp(App);
app.use(router);
app.mount('#app');