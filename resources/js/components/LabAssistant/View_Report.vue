<template>
    <div class="inner-div">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-light table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Report ID</th>
                        <th scope="col">Patient ID</th>
                        <th scope="col">File Version</th>
                        <th scope="col">File Name</th>
                        
                        <th scope="col">Create Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Print</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="report in reports">

                        <td>{{ report.report_id }}</td>
                        <td>{{ report.patient_id }}</td>
                        <td>{{ report.test }}</td>
                        <td>{{ report.file }}</td>
                        <!-- <td><a href="{{asset('storage/uploads/{{ report.file }}')}}">report<a></td> -->
                        <td>{{ report.created_at }}</td>
                        <td>{{ report.updated_at }}</td>
                        
                        
                        <td><button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="getpdf(report_id)">Print</button></td>
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
                reports: [],
                //user_role_name: '',
            }
        },

        mounted() {
            this.getReport();
        },

        methods: {
            getReport() {
                axios.get('/lab/upload/show').then((response) =>{
                    this.reports = response.data;
                    // console.log(response.data);
                })
            },

            getpdf(report_id) {
                axios.get('/lab/upload/getReport' + reports.report_id).then( (response)=>{
                     this.getReport();
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