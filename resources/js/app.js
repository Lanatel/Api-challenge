require('./bootstrap');

import vue from 'vue'
import TrustFlowScore from './components/TrustFlowScore.vue';

window.Vue = vue;

Vue.component('trust-flow-score', TrustFlowScore);

new Vue({
    el: '#app'
});
