import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import './assets/main.css'


// App.vue

// createApp(App).mount('#app')
const app = createApp(App);
app.use(router);
app.mount('#app');