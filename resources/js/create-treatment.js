
require('./bootstrap');

window.Vue = require('vue');

Vue.component('create-treatment', require('./components/treatments/create.vue').default);

const app = new Vue({
    el: '#app',
});
