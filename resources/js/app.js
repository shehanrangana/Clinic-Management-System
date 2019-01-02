

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//  Welcome page components
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('welcome', require('./components/Welcome.vue'));

// General componenets
Vue.component('clock',require('./components/Clock.vue'));
Vue.component('profile',require('./components/Profile.vue'));


// Components of admin
Vue.component('admin-dashboard', require('./components/Admin/Dashboard.vue'));
Vue.component('user-register', require('./components/Admin/User_Register.vue'));
Vue.component('users', require('./components/Admin/Users.vue'));
Vue.component('patients', require('./components/Admin/Patients.vue')); 

// Components of receptionist
Vue.component('recept-dashboard', require('./components/Receptionist/Dashboard.vue'));
Vue.component('patient-register', require('./components/Receptionist/Patient_Register.vue'));
Vue.component('queue', require('./components/Receptionist/Queue.vue'));
Vue.component('queue-tables', require('./components/Receptionist/Queue_tables.vue'));

// Components of nurse
//Vue.component('make-appointment', require('./components/Nurse/Make_Appointment.vue'));
Vue.component('make-appointment', require('./components/Nurse/Make_Appointment_New.vue'));
Vue.component('appointment-count', require('./components/Nurse/Appointment_Count.vue'));
Vue.component('appointment-list', require('./components/Nurse/Appointment_List.vue'));

// Elements of admin
// Components of doctor
Vue.component('doctor-dashboard', require('./components/Doctor/Dashboard.vue'));

// Vue primary instant
const app = new Vue({
    el: '#app',
});

// Vue clock instant
const clock = new Vue({
    el: '#clock',
});



