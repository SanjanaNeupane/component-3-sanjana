
require('./bootstrap');
import VueRouter from 'vue-router';
import routes from './routes';

window.Vue = require('vue');

Vue.use(VueRouter);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('product', require('./components/Product.vue').default);




const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
