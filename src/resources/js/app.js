require('./bootstrap');

import { createApp } from 'vue';
import TestComponent from './components/TestComponent.vue';

// window.createApp = createApp;
// window.HelloComponent = require('./components/Hello.vue').default;

createApp({
    components:{
        TestComponent
    }
}).mount('#app')

