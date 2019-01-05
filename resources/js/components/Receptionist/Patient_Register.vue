<template>
    <div class="inner-div">
        <div class="container">
            <form @submit="registerPatient()">
                <div class="form-group">
                  <label for="patient_id">Patient ID</label>
                  <input v-validate="'required|digits:4'" autofocus type="text" class="form-control" id="patient_id" name="patient_id" v-bind="{ placeholder: pHolder }" v-model="newPatient.patient_id" required>
                  <div class="error-feedback">
                    <span>{{ errors.first('patient_id') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input v-validate="'required'" autofocus type="text" class="form-control" id="name" name="name" placeholder="Enter name" v-model="newPatient.name" required>
                  <div class="error-feedback">
                    <span>{{ errors.first('name') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="address_line_1">Address Line 1</label>
                  <input v-validate="'required'" autofocus type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="Address Line 1" v-model="newPatient.address_line_1" required>
                  <div class="error-feedback">
                    <span>{{ errors.first('address_line_1') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="address_line_2">Address Line 2</label>
                  <input v-validate="'required'" autofocus type="text" class="form-control" id="address_line_2" name="address_line_2" placeholder="Address Line 2" v-model="newPatient.address_line_2" required>
                  <div class="error-feedback">
                    <span>{{ errors.first('address_line_2') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="addressLine3">Address Line 3</label>
                  <input type="text" class="form-control" id="address_line_3" name="address_line_3" placeholder="Address Line 3" v-model="newPatient.address_line_3" >
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
                            <date-picker v-validate="'required|date_format:YYYY-MM-DD'" autofocus :lang="lang" name="birthday" :required="true" v-model="newPatient.birthday"></date-picker>
                            <div class="error-feedback">
                              <span>{{ errors.first('birthday') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="contact_number">NIC</label>
                  <input v-validate="{ required: true, length:10, regex:/^([0-9]+[v,V])$/ }" autofocus type="text" class="form-control" id="nic" name="nic" placeholder="Enter NIC number" v-model="newPatient.nic" required>
                  <div class="error-feedback">
                    <span>{{ errors.first('nic') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="contact_number">Contact number</label>
                  <input v-validate="'required|digits:10'" autofocus type="tel" class="form-control" id="contact_number" name="contact_number" placeholder="Enter contact number" v-model="newPatient.contact_number" required>
                  <div class="error-feedback">
                    <span>{{ errors.first('contact_number') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="guardian_number">Guardian's contact number</label>
                  <input v-validate="'required|digits:10'" autofocus type="tel" class="form-control" id="guardian_number" name="guardian_number" placeholder="Enter guardian's contact number" v-model="newPatient.guardian_number">
                  <div class="error-feedback">
                    <span>{{ errors.first('guardian_number') }}</span>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
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
                newPatient: {'patient_id': '', 'name': '', 'address_line_1': '', 'address_line_2': '', 'address_line_3': '',  'gender': 'Male', 'birthday': '', 'nic': '', 'contact_number': '', 'guardian_number': ''},
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
                    this.getLastId();
                }).catch(err => {
                    this.hasError = true;
                });
            },

            getLastId() {
                axios.get('/recept/patient_register/get_last').then( (response)=>{
                    if(response.data != ""){
                        this.pHolder = "Recently added " + response.data;
                    }else{
                        this.pHolder = "use 0001";
                    }
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