<template>
    <div class="inner-div">
            <form class="form-inline">
                <div class="container">
                <div class="row">
                    <div class="col">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <date-picker :lang="lang" name="date" id="date" :required="true" v-model="appointments.date"></date-picker>
                            </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="timeslot">Time</label>
                            <select class="form-control" id="timeslot" name="timeslot" v-model="appointments.timeslot" required>
                                <option>08-09</option>
                                <option>09-10</option>
                                <option>10-11</option>
                                <option>11-12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" @click.prevent="getAppointments()">Search</button>
                    </div>
                </div>
                
            </div>
            </form>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Patient Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="appointment in appointments">
                        <td>{{ appointment.patient_id }}</td>
                        <td>{{ appointment.name}}</td>
                        <td><button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="cancelAppointment()">cancel</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';

    export default {
        components: { DatePicker },

        data() {
            return {
                //appointments: [],
                appointments: {'patient_id': '','name':'','date':'','timeslot':''},

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

        // mounted: function mounted() {
        //     this.getAppointments();
        // },

        methods: {
            getAppointments() {
                let date=this.formatDate(this.appointments.date);
                axios.get('/nurse/appointment_list/show', {params: {date: date,timeslot:this.appointments.timeslot}}).then( (response)=>{
                    this.appointments = response.data;
                    console.log(response.data);
                })
            },

            //convert the date from Thu Nov 28 2018 00:00:00 GMT+0530 (India Standard Time) format to 2018-11-28 format
            formatDate(str){
                var date = new Date(str),
                    mnth = ("0" + (date.getMonth()+1)).slice(-2),
                    day  = ("0" + date.getDate()).slice(-2);
                return [ date.getFullYear(), mnth, day ].join("-");
            },

            cancelAppointment(){
                let date=this.formatDate(this.appointments.date);
                axios.post('/nurse/appointment_list/cancel', {date: date,patient_id: this.appointsments.patient_id}).then( (response)=>{
                    
                });
            }
        }
    }
</script>

<style>
    .table td, .table th {
        vertical-align: inherit;
    }
</style>