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
                        <td>{{ counts[0] }}</td>
                        <td></td>    
                    </tr>
                    <tr>
                        <td>9-10</td>
                        <td>{{ counts[1] }}</td>
                        <td></td>    
                    </tr>
                    <tr>
                        <td>10-11</td>
                        <td>{{ counts[2] }}</td>
                        <td></td>    
                    </tr>
                    <tr>
                        <td>11-12</td>
                        <td>{{ counts[3] }}</td>
                        <td></td>    
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
                counts: [],
            }
        },

        mounted: function mounted() {
            this.getCounts();
        },

        methods: {
            getCounts() {
                axios.get('/nurse/make_appointment/count').then( (response)=>{
                    this.counts = response.data;
                    //console.log(response.data);
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