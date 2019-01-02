<template>
        <div class="inner-div">
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Time</th>
                                <th scope="col">No of appointments</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>8-9</td>
                                <td>{{ countStatus[0] }}</td>
                                <td>{{ countStatus[1] }}</td>    
                            </tr>
                            <tr>
                                <td>9-10</td>
                                <td>{{ countStatus[2] }}</td>
                                <td>{{ countStatus[3] }}</td>    
                            </tr>
                            <tr>
                                <td>10-11</td>
                                <td>{{ countStatus[4] }}</td>
                                <td>{{ countStatus[5] }}</td>    
                            </tr>
                            <tr>
                                <td>11-12</td>
                                <td>{{ countStatus[6] }}</td>
                                <td>{{ countStatus[7] }}</td>    
                            </tr>
                        </tbody>
                    </table>
                </div>
           
        <form @submit="makeAppointment()">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nic">Patient id</label>
                        <input type="text" class="form-control" id="patient_id" name="patient_id" placeholder="Enter patient id" v-model="newAppointment.patient_id" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <br>
                        <date-picker :lang="lang" name="date" :required="true" v-model="newAppointment.date"></date-picker>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="timeslot">Time</label>
                        <select class="form-control" id="timeslot" name="timeslot" v-model="newAppointment.timeslot" required>
                            <option>8-9</option>
                            <option>9-10</option>
                            <option>10-11</option>
                            <option>11-12</option>
                        </select>
                    </div>
                </div>
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
                newAppointment: {'patient_id': '', 'date': '', 'timeslot': '8-9'},
                appointments: [],
                countStatus: [],


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

        mounted: function mounted() {
            this.getCountStatus();
        },

        methods: {
            getPatients: function getPatients() {
                var _this = this;
                axios.get('/recept/patient_register/show').then(function (response){
                    _this.users = response.data;
                    console.log(response.data);
                })
            },
            registerPatient() {
                var input = this.newPatient;
                axios.post('/recept/patient_register/store', input).then( (response) => {
                    this.newPatient = {'patient_id': '', 'name': '', 'address_line_1': '', 'address_line_2': '', 'address_line_3': '',  'gender': 'Male', 'birthday': '', 'nic': '', 'contact_no': '', 'guardian_no': ''};
                    this.getLastId();
                }).catch(err => {
                    this.hasError = true;
                });
            },

            makeAppointment() {
                var input = this.newAppointment;
                axios.post('/nurse/make_appointment/add', input).then((response)=>{
                    this.newAppointment = {'date': '', 'timeslot': '8-9', 'patient_id': ''}
                    
                }).catch(err => {
                    this.hasError = true;
                });
            },

            getCountStatus() {
                axios.get('/nurse/make_appointment/count').then( (response)=>{
                    this.countStatus = response.data;
                    //console.log(response.data);
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
    .table td, .table th {
        vertical-align: inherit;
    }
    
</style>