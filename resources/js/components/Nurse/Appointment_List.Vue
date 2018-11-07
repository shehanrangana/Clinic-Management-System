<template>
    <div class="inner-div">
        <div class="table-responsive">
            <table class="table table-hover table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Patient Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="appointment in appointments">
                        <td>{{ appointment.patient_id }}</td>
                        <td></td>
                        <td></td>
                        <td><button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="">cancel</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                appointments: [],
            }
        },

        mounted: function mounted() {
            this.getAppointments();
        },

        methods: {
            getAppointments() {
                axios.get('/nurse/appointment_list/show').then( (response)=>{
                    this.appointments = response.data;
                    // console.log(response.data);
                })
            }

            

        }
    }
</script>

<style>
    .table td, .table th {
        vertical-align: inherit;
    }
</style>