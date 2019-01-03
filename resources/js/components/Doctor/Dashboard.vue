<template>
    <div>
        <b-row>
            <b-col cols="3">
                <h5>Queue List</h5>
                <div class="inner-div">
                    <!-- Queue list -->
                    <b-list-group>
                        <b-list-group-item href="#" @click="expand(patient)" v-for="patient in patientList" :key="patient.index">
                            <h6><b-badge variant="info" pil>{{ patient.number }}</b-badge>
                            {{ patient.name }}</h6>
                        </b-list-group-item>
                    </b-list-group>
                </div>
            </b-col>
            <b-col cols="9">
                <h5>Patient Medical History</h5>
                <div class="inner-div">
                    <div v-for="oneDay in patientHistory" :key="oneDay.index">
                        <!-- {{oneDay}} -->
                        <b-card :sub-title=oneDay[0].date>
                            <p v-for="item in oneDay" :key="item.index">
                                <b>{{item.drug_name}} {{item.quantity}}</b>
                                <br>
                                <i>{{item.comments}}</i>
                            </p>
                        </b-card>
                    </div>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import { ListGroup } from 'bootstrap-vue/es/components';
Vue.use(ListGroup);

export default {
    data () {
        return {
            patientList: [],
            patientHistory: [],
        }
    },

    created() {
        // This will fire whenever receptionist update queue
        window.Echo.channel('queue-channel').listen('.queue-started', event =>{
            this.getQueueList();
        });
    },

    mounted() {
        this.getQueueList();
    },

    methods: {
        // Get patient list of current queue
        getQueueList() {
            axios.get('/doctor/dashboard/get_queue').then( (response)=>{
                if(response.data != -1){
                    this.patientList = response.data;
                }
            })
        },

        // Expand patient profile
        expand(patient) {
            axios.get('/doctor/dashboard/patient_history', {params: {patient_id: patient.patient_id}}).then( (response)=>{
                this.patientHistory = response.data;
                console.log(response.data);
            })
        }
    }
}
</script>

<style>
.inner-div {
    padding: 10px 10px 10px 10px;
}
.col-4 {
    padding-left: 0px;
    padding-right: 0px;
}
.col-8 {
    padding-right: 0px;
}
.card {
    margin-bottom: 10px;
}
.badge {
    /* padding: 0.75em; */
    border-radius: 1rem;
    margin-right: 1em;
}
.list-group-item {
    padding: 5px 10px 5px 10px!important;
}
</style>
