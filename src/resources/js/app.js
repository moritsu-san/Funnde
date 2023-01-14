require('./bootstrap');
import { createApp } from 'vue';
import LikeComponent from './components/LikeComponent.vue';
import { getPosts } from './test.js';

getPosts();

const app = createApp({});

app.component('like-component', LikeComponent);
app.mount('#app');
