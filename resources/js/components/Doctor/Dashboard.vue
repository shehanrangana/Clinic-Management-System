<template>
    <div class="inner-div">
        <!-- Queue list -->
        <b-list-group>
            <b-list-group-item  v-for="patient in patientList" :key="patient.index" href="#some-link">{{ patient.number+ " " +patient.patient_id + " " +patient.name}}</b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
import { ListGroup } from 'bootstrap-vue/es/components';
Vue.use(ListGroup);

export default {
    data () {
        return {
            patientList: [],
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
    }
}
</script>