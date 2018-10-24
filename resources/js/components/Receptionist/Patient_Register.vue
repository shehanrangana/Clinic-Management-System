<template>
    <div class="inner-div">
        <div class="container">
            <form @submit.prevent="registerPatient()">
                <div class="form-group">
                  <label for="patient_id">Patient ID</label>
                  <input type="text" class="form-control" id="patient_id" name="patient_id" v-bind="{ placeholder: pHolder }" v-model="newPatient.patient_id" required>
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" v-model="newPatient.name" required>
                </div>
                <div class="form-group">
                    <label for="addressLine1">Address Line 1</label>
                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="Address Line 1" v-model="newPatient.address_line_1" required>
                </div>
                <div class="form-group">
                  <label for="addressLine1">Address Line 2</label>
                  <input type="text" class="form-control" id="address_line_2" name="address_line_2" placeholder="Address Line 2" v-model="newPatient.address_line_2" required>
                </div>
                <div class="form-group">
                  <label for="addressLine3">Address Line 3</label>
                  <input type="text" class="form-control" id="address_line_3" name="address_line_3" placeholder="Address Line 3" v-model="newPatient.address_line_3" required>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" v-model="newPatient.gender" required>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <br>
                            <date-picker :lang="lang" name="birthday" :required="true" v-model="newPatient.birthday"></date-picker>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_no">NIC</label>
                    <input type="tel" class="form-control" id="nic" name="nic" placeholder="Enter NIC number" v-model="newPatient.nic" required>
                </div>
                <div class="form-group">
                    <label for="contact_no">Contact number</label>
                    <input type="tel" class="form-control" id="contact_no" name="contact_no" placeholder="Enter contact number" v-model="newPatient.contact_no" required>
                </div>
                <div class="form-group">
                    <label for="guardian_no">Guardian's contact number</label>
                    <input type="tel" class="form-control" id="guardian_no" name="guardian_no" placeholder="Enter guardian's contact number" v-model="newPatient.guardian_no" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template> 

<script>
import DatePicker from 'vue2-datepicker';

    export default {
        components: { DatePicker },

        data() {
            return {
                // Patient object
                newPatient: {'patient_id': '', 'name': '', 'address_line_1': '', 'address_line_2': '', 'address_line_3': '',  'gender': 'Male', 'birthday': '', 'nic': '', 'contact_no': '', 'guardian_no': ''},
                patients: [],

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

                // Placeholder of ID field
                pHolder: '',
            }
        },

        mounted() {
            this.getLastId();
        },

        methods: {
            registerPatient() {
                var input = this.newPatient;
                axios.post('/recept/patient_register/store', input).then( (response) => {
                    this.newPatient = {'patient_id': '', 'name': '', 'address_line_1': '', 'address_line_2': '', 'address_line_3': '',  'gender': 'Male', 'birthday': '', 'nic': '', 'contact_no': '', 'guardian_no': ''};
                    this.getLastId();
                    // console.log("awa");
                }).catch(err => {
                    this.hasError = true;
                });
            },

            getLastId() {
                axios.get('/recept/patient_register/get_last').then( (response)=>{
                    this.pHolder = "Recently added " + response.data;
                })
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