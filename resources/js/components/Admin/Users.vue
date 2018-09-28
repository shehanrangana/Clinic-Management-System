<template>
    <div >
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-light">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact number</th>
                        <th scope="col">User role</th>
                        <th scope="col">Qualification</th>
                        <th scope="col">SLMC Reg. no</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <td>{{ user.user_id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.gender }}</td>
                        <td>{{ user.birthday }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.contact_no }}</td>
                        <td>{{ user.user_role }}</td>
                        <td>{{ user.qualification }}</td>
                        <td>{{ user.slmc_number }}</td>
                        <td><button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="removeUser(user)">Remove</button></td>
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
                users: [],
            }
        },

        mounted: function mounted() {
            this.getUsers();
        },

        methods: {
            getUsers: function getUsers() {
                var _this = this;
                axios.get('/admin/users/show').then(function (response){
                    _this.users = response.data;
                    // console.log(response.data);
                })
            },

            removeUser: function removeUser(user) {
                var _this = this;
                axios.post('/admin/users/remove/' + user.user_id).then(function (response){
                    _this.getUsers();
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