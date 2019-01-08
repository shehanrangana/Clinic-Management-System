<template>
    <div class="inner-div">
            <form class="form-inline">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="date">Date </label>
                        <date-picker class="date-picker" @change="getCountStatus(); getAppointmentforDate();" :lang="lang" name="date" id="date" :required="true" v-model="newAppointment.date"></date-picker>
                    </div>  
                </div>
                <div class="col">   
                </div>
            </div>   
                </form>
                <br>
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
                        <tr class='clickable-row' @click="getAppointments('08-09')">
                            <td>8-9</td>
                            <td>{{ count._0809 }}</td>
                            <td>{{ status._0809 }}</td>    
                        </tr>
                        <tr class='clickable-row' @click="getAppointments('09-10')">
                            <td>9-10</td>
                            <td>{{ count._0910 }}</td>
                            <td>{{ status._0910 }}</td>    
                        </tr>
                        <tr class='clickable-row' @click="getAppointments('10-11')">
                            <td>10-11</td>
                            <td>{{ count._1011 }}</td>
                            <td>{{ status._1011 }}</td>    
                        </tr>
                        <tr class='clickable-row' @click="getAppointments('11-12')">
                            <td>11-12</td>
                            <td>{{ count._1112 }}</td>
                            <td>{{ status._1112 }}</td>    
                        </tr>
                    </tbody>
                </table>
            </div>
    <br>
    <form @submit.prevent="makeAppointment()">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nic">Patient id</label>
                    <input type="text" @blur="checkPatientID()" class="form-control" id="patient_id" name="patient_id" placeholder="Enter patient id" v-model="newAppointment.patient_id" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="timeslot">Time</label>
                    <select class="form-control" id="timeslot" name="timeslot" v-model="newAppointment.timeslot" required>
                        <option>08-09</option>
                        <option>09-10</option>
                        <option>10-11</option>
                        <option>11-12</option>
                    </select>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary" >Add Appointment</button>
    </form>
    <br>
    <br>
    <h5>Appointments</h5>
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
                    <td><button type="button" class="btn btn-danger btn-sm" @click.prevent="cancelAppointment(appointment)">cancel</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template> 

<script>
import DatePicker from 'vue2-datepicker';

import swal from 'sweetalert';

export default {
    components: { DatePicker },

    data() {
        return {
            newAppointment: {'date': '', 'timeslot': '8-9', 'patient_id': ''},
            appointments: {'patient_id': '','name':'','date':'','timeslot':''},
            count:{'_0809': '','_0910': '','_1011': '','_1112': ''},
            status:{'_0809': '', '0910': '', '1011': '', '1112': ''},
            

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
    //     this.getCountStatus();
    // },

    methods: {

        //adding appointments
        makeAppointment() {
            if(this.newAppointment.date){
               
                if(this.getStatusForTimeslot(this.newAppointment.timeslot)=='Not Full'){

                    this.newAppointment.date=this.formatDate(this.newAppointment.date);
                    var input = this.newAppointment;

                    axios.post('/recept/appointments/add', input).then((response)=>{
                       
                        switch (response.data.timeslot) {
                                case '08-09':
                                    this.count._0809 += 1;
                                    this.status._0809=this.getStatus(this.count._0809);
                                    break;
                                case '09-10':
                                    this.count._0910 += 1;
                                    this.status._0910=this.getStatus(this.count._0910);
                                    break;
                                case '10-11':
                                    this.count._1011 += 1;
                                    this.status._1011=this.getStatus(this.count._1011);
                                    break;
                                case '11-12':
                                    this.count._1112 += 1;
                                    this.status._1112=this.getStatus(this.count._1112);
                                    break;
                            }
                            this.getAppointments(response.data.timeslot);
                            this.newAppointment = {'date': this.newAppointment.date, 'timeslot': '8-9', 'patient_id': ''};
                            // alert("Appointment added successfully");
                            swal("Done", "Appointment added successfully ", "success");

                    }).catch(err => {
                        this.hasError = true;
                        if(this.checkPatientID()==0){
                            console.log("Invalid Patient ID");
                        }else if(this.checkAppointment()==0){
                            console.log("You already added the appointment");
                            
                        }
                    });
                    
                    }else{
                        //console.log(this.getStatusForTimeslot(this.newAppointment.timeslot));
                        // alert("TImeslot is full. Select another timeslot or date");\
                        swal("Error !", "Timeslot is full. Select another timeslot or date ", "error");
                    }
                }else{
                    // alert("Please select a date");
                    swal("Warning !", "Please select a date ", "warning");
                }
        },


        //get the no of appointments & state whether the timeslot full or not for relavant date & timeslots
        getCountStatus() {
            let date=this.formatDate(this.newAppointment.date);

            axios.get('/recept/appointments/count/'+date).then( (response)=>{
                this.count = response.data;
                console.log(this.count);
                this.status._0809=this.getStatus(this.count._0809);
                this.status._0910=this.getStatus(this.count._0910);
                this.status._1011=this.getStatus(this.count._1011);
                this.status._1112=this.getStatus(this.count._1112);
            })
            
        },


        //convert the date from Thu Nov 28 2018 00:00:00 GMT+0530 (India Standard Time) format to 2018-11-28 format
        formatDate(str){
            var date = new Date(str),
                mnth = ("0" + (date.getMonth()+1)).slice(-2),
                day  = ("0" + date.getDate()).slice(-2);
            return [ date.getFullYear(), mnth, day ].join("-");
        },


        //check the count/no of appointsments for timeslots full or not 
        getStatus(count){
            if(count>=20){
                status="Full";
            }else {
                status="Not Full";
            }
            return status;
        },


        //get the status for given timeslot
        getStatusForTimeslot($timeslot){
            switch ($timeslot) {
                case '08-09':
                    return this.status._0809;
                case '09-10':
                    return this.status._0910;
                case '10-11':
                    return this.status._1011;
                case '11-12':
                    return this.status._1112;
            }
        },


        //check validity of the patient id 
        checkPatientID(){
            // console.log(this.newAppointment.patient_id);
            if(this.newAppointment.patient_id){
                axios.get('/recept/appointments/checkid', {params: {patient_id: this.newAppointment.patient_id}}).then( (response)=>{
                    //console.log(response.data);
                    if(response.data==0){
                        // alert("Invalid Patient ID");
                        swal("Error !", "Invalid Patient ID !", "error");
                    }
                    return response.data;
                   
                });
            }
        },


        //check there is a appointment for given patient id & date already
        checkAppointment(){
            // console.log(this.newAppointment.patient_id);
                let date=this.formatDate(this.newAppointment.date);
                axios.get('/recept/appointments/checkappointment', {params: {date:date,patient_id: this.newAppointment.patient_id}}).then( (response)=>{
                    //console.log(response.data);
                    if(response.data==0){
                        // alert("You already added the appointment");
                        swal("You already added the appointment !", " ", "info");
                    }
                    return response.data;
                   
                });
            
        },
        //get appointments for relavant date 
        getAppointmentforDate(){
            if(this.newAppointment.date){
                let date=this.formatDate(this.newAppointment.date);
                console.log(date);
                
                axios.get('/recept/appointments/showfordate', {params: {date: date}}).then( (response)=>{
                    this.appointments = response.data;
                    console.log(response.data);
                })
            }else{
                // alert("Please select a date");
                swal("Please select a date ", " ", "info");
            }
        },

        //get appointments for relavant date & timeslot
        getAppointments($timeslot){
            if(this.newAppointment.date){
                let date=this.formatDate(this.newAppointment.date);
                console.log(date);
                console.log($timeslot);
                axios.get('/recept/appointments/show', {params: {date: date,timeslot:$timeslot}}).then( (response)=>{
                    this.appointments = response.data;
                    console.log(response.data);
                })
            }else{
                // alert("Please select a date");
                swal("Please select a date ", " ", "info");
            }
        },

        //cancel appointments
        cancelAppointment(appointment){
                let date=this.formatDate(this.newAppointment.date);
                console.log(date);
                console.log(appointment.patient_id);
                axios.post('/recept/appointments/cancel', {date: date,patient_id: appointment.patient_id}).then( (response)=>{
                    this.getAppointments(appointment.timeslot);
                    switch (appointment.timeslot) {
                                case '08-09':
                                    this.count._0809 -= 1;
                                    this.status._0809=this.getStatus(this.count._0809);
                                    break;
                                case '09-10':
                                    this.count._0910 -= 1;
                                    this.status._0910=this.getStatus(this.count._0910);
                                    break;
                                case '10-11':
                                    this.count._1011 -= 1;
                                    this.status._1011=this.getStatus(this.count._1011);
                                    break;
                                case '11-12':
                                    this.count._1112 -= 1;
                                    this.status._1112=this.getStatus(this.count._1112);
                                    break;
                    }
                    // alert("Appointment canceled")
                    swal("Done", "Appointment canceled ", "success");
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
.table td, .table th {
    vertical-align: inherit;
}
.date-picker {
    width: 100%;
}
</style>