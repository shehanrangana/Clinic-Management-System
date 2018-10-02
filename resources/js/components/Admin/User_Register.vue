<template>
    <div class="container">
        <form @submit.prevent="registerUser()">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" v-model="newUser.name" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" v-model="newUser.gender" required>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <br>
                        <date-picker :lang="lang" name="birthday" v-model="newUser.birthday" style="font-family: 'Roboto', sans-serif;"></date-picker>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" v-model="newUser.email" required>
                <div class="alert alert-danger" role="alert" v-bind:class="{'d-none': !hasError}">
                    This email address is already in database
                </div>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact number</label>
                <input type="tel" class="form-control" id="contact_no" name="contact_no" placeholder="Enter contact number" v-model="newUser.contact_no" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="user_role">Role</label>
                        <select class="form-control" id="user_role" name="user_role" v-model="newUser.user_role" required>
                            <option>Admin</option>
                            <option>Receptionist</option>
                            <option>Doctor</option>
                            <option>Nurse</option>
                            <option>Lab Assistant</option>
                            <option>Pharmacist</option>
                        </select>
                    </div>
                </div>
                <div class="col" v-if="newUser.user_role=='Admin' || newUser.user_role=='Doctor'">
                    <div class="form-group">
                        <label for="slmc_number">SLMC Registration number</label>
                        <input type="text" class="form-control" id="slmc_number" name="slmc_number" placeholder="Enter SLMC reg. no" v-model="newUser.slmc_number" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="qualification">Qualification</label>
                <select class="form-control" id="qualification" name="qualification" v-model="newUser.qualification" required>
                    <template v-if="newUser.user_role=='Admin' || newUser.user_role=='Doctor'">
                        <option>MBBS</option>
                        <option>MD</option>
                    </template>
                    <template v-else-if="newUser.user_role=='Receptionist'">
                        <option>Receptionist qualification 1</option>
                        <option>Receptionist qualification 2</option>
                    </template>
                    <template v-else-if="newUser.user_role=='Nurse'">
                        <option>Nurse qualification 1</option>
                        <option>Nurse qualification 2</option>
                    </template>
                    <template v-else-if="newUser.user_role=='Lab Assistant'">
                        <option>Lab Assistant qualification 1</option>
                        <option>Lab Assistant qualification 2</option>
                    </template>
                    <template v-else-if="newUser.user_role=='Pharmacist'">
                        <option>Pharmacist qualification 1</option>
                        <option>Pharmacist qualification 2</option>
                    </template>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template> 

<script>
import DatePicker from 'vue2-datepicker';

    export default {
        components: { DatePicker },

        data() {
            return {
                newUser: {'name': '', 'gender': 'Male', 'birthday': '', 'email': '', 'contact_no': '', 'user_role': 'Admin', 'slmc_number': '', 'qualification': ''},
                users: [],

                // setup calander
                lang: {
                    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
                    placeholder: {
                        date: 'Select Date',
                    }
                },

                hasError: false,
            }
        },

        methods: {
            getUsers: function getUsers() {
                var _this = this;
                axios.get('/admin/user_register/show').then(function (response){
                    // _this.users = response.data;
                    console.log(response.data);
                    
                })
            },

            registerUser: function registerUser() {
                var input = this.newUser;
                var output = this;
                axios.post('/admin/user_register/store', input).then(function (response){
                    output.newUser = {'name': '', 'gender': 'Male', 'birthday': '', 'email': '', 'contact_no': '', 'user_role': 'Admin', 'slmc_number': '', 'qualification': ''}
                    // output.getUsers();
                }).catch(err => {
                    this.hasError = true;
                });
            }
        }
    }
</script>

<style>
    @media (min-width: 1200px) {
        .container{
            max-width: 750px;
        }
    }
    .mx-datepicker {
        width: 100%;
    }
    .mx-datepicker-popup {
        z-index: 2000; /*bring datepicker to the front*/
    }
    .mx-input {
        -webkit-box-shadow:none;
        box-shadow: none;
        height: 38px;
    }
</style>