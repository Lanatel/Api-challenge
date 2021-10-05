require('./bootstrap');

import vue from 'vue'
import TrustFlowScore from './components/TrustFlowScore.vue';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = vue;

Vue.component('trust-flow-score', TrustFlowScore);

new Vue({
    el: '#app'
});
