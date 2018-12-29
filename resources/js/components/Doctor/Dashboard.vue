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

    mounted() {
        console.log("App mounted");
        this.getQueueList();
    },

    methods: {
        getQueueList() {
            axios.get('/doctor/dashboard/get_queue').then( (response)=>{
                this.patientList = response.data;
                // console.log(response.data);
            })
        },
    }
}
</script>