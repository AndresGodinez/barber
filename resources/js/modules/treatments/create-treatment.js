require('../../bootstrap');

import Vue from 'vue';
import store from './treatments-store'
import 'v2-table/dist/index.css';
import 'beautify-scrollbar/dist/index.css';
import V2Table from 'v2-table';

import BootstrapVue from 'bootstrap-vue'

Vue.component('create-treatment', require('../../components/treatments/create.vue').default);

Vue.use(V2Table);
Vue.use(BootstrapVue);

import VModal from 'vue-js-modal';

Vue.use(VModal, { dynamic: true, injectModalsContainer: true });

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueCurrencyFilter from 'vue-currency-filter'

Vue.use(VueCurrencyFilter,
    {
        symbol : '$',
        thousandsSeparator: ',',
        fractionCount: 2,
        fractionSeparator: '.',
        symbolPosition: 'front',
        symbolSpacing: true
    });

const app = new Vue({
    store,
    el: '#app',
});
