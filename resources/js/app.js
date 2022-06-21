
require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('jocs', require('./components/jocsVue/JocsComponent.vue').default);
Vue.component('jocsUsers', require('./components/jocsVue/JocsUser.vue').default);
Vue.component('reserves', require('./components/reservaVue/ReservaComponent.vue').default);
Vue.component('users', require('./components/usersVue/UsersComponent.vue').default);
Vue.component('profile', require('./components/usersVue/editProfile.vue').default);
Vue.component('sales', require('./components/saleVue/SalesVue.vue').default);
Vue.component('valoracions', require('./components/valoraVue/ValoraComponent.vue').default);


const app = new Vue({
    el: '#app',
});
