

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// General componenets
Vue.component('autocomplete',require('./components/Autocomplete.vue'));

// Components of admin
Vue.component('admin-dashboard', require('./components/Admin/Dashboard.vue'));
Vue.component('user-register', require('./components/Admin/User_Register.vue'));
Vue.component('users', require('./components/Admin/Users.vue'));
Vue.component('patients', require('./components/Admin/Patients.vue'));

// Components of receptionist
Vue.component('patient-register', require('./components/Receptionist/Patient_Register.vue'));
Vue.component('queue', require('./components/Receptionist/Queue.vue'));

// Elements of admin
const app = new Vue({
    el: '#app',
});

// const user_register = new Vue({
//     el: '#user_register',
// });

// const users = new Vue({
//     el: '#users',
// });

// const patients = new Vue({
//     el: '#patients',
// });

// Elements of receptionist
// const patient_register = new Vue({
//     el: '#patient_register',
// });



