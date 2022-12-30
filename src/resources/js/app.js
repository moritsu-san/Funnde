require('./bootstrap');

import { create } from 'lodash';

import { createApp } from 'vue';
import LikeComponent from './components/LikeComponent.vue';

const app = createApp({})

app.component('like-component', LikeComponent);
app.mount('#app')

