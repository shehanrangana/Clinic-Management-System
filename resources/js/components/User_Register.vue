<template>
    <div class="container">
        <p v-bind:class="{invisible: hasError}">please fill all the fields<p>
        <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter name">
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Birthday</label>
                        <br>
                        <date-picker v-model="date" :lang="lang"></date-picker>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="contact_no">Contact number</label>
                <input type="tel" class="form-control" id="contact_no" placeholder="Enter contact number">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role">
                    <option>Admin</option>
                    <option>Receptionist</option>
                    <option>Doctor</option>
                    <option>Nurse</option>
                    <option>Lab Assistant</option>
                    <option>Pharmacy</option>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Degree</label>
                <select class="form-control" id="role">
                    <option>MBBS</option>
                    <option>MD</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';

    export default {
        components: { DatePicker },

        data() {
            return {
                newItem: {'name': '', 'age': '', 'profession': ''},
                hasError: true,
                date: '',
                lang: {
                    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
                    placeholder: {
                        date: 'Select Date',
                        dateRange: 'Select Date Range'
                    }
                }
            }
        },

        methods: {
            createItem: function createItem() {
                var input = this.newItem;
                if(input['name'] == '' || input['age'] == '' || input['profession'] == ''){
                    this.hasError = false
                }else{
                    this.hasError = true;
                    axios.post('/storeItem', input).then(function (response){

                    });
                }
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
</style>