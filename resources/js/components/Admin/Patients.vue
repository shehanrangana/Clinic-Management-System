<template>
    <div >
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-light">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">NIC</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address Line 1</th>
                        <th scope="col">Address Line 2</th>
                        <th scope="col">Address Line 3</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Contact number</th>
                        <th scope="col">Guardian's number</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="patient in patients">
                        <td>{{ patient.nic }}</td>
                        <td>{{ patient.name }}</td>
                        <td>{{ patient.address_line_1 }}</td>
                        <td>{{ patient.address_line_2 }}</td>
                        <td>{{ patient.address_line_3 }}</td>
                        <td>{{ patient.gender }}</td>
                        <td>{{ patient.birthday }}</td>
                        <td>{{ patient.contact_no }}</td>
                        <td>{{ patient.guardian_no }}</td>
                        <td><button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="removePatient(patient)">Remove</button></td>
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
                patients: [],
            }
        },

        mounted: function mounted() {
            this.getPatients();
        },

        methods: {
            getPatients() {
                axios.get('/admin/patients/show').then( (response)=>{
                    this.patients = response.data;
                    // console.log(response.data);
                })
            },

            removePatient(patient) {
                axios.post('/admin/patients/remove/' + patient.nic).then((response)=>{
                    this.getPatients();
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