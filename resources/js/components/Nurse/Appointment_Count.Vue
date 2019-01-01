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
    </div>
</template>

<script>
    export default {

        data() {
            return {
                countStatus: [],

            }
        },

        mounted: function mounted() {
            this.getCountStatus();
        },

        methods: {
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
    .table td, .table th {
        vertical-align: inherit;
    }
</style>