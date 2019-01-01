<template>
    <div class="inner-div">
        <div class="container">
            <form @submit.prevent="addDrugs()">
                <div class="form-group">
                  <label for="name">Drugs Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter drug name" v-model="newDrug.name" required>
                </div>
                <div class="form-group">
                  <label for="quantity">Quantity of Drugs</label>
                  <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter drug quantity" v-model="newDrug.quantity" required>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="brand">Brand of Drug</label>
                            <select class="form-control" id="brand" name="brand" v-model="newDrug.brand" required>
                                <option>NMRA</option>
                                <option>SLMA</option>
                                <option>MDMA</option>
                                <option>MLSLA</option>
                                <option>SLI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="expireDate">Expire Date</label>
                            <br>
                            <date-picker :lang="lang" name="expireDate" v-model="newDrug.expireDate" style="font-family: 'Roboto', sans-serif;"></date-picker>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Supplier Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter supplier email" v-model="newDrug.email" required>
                    <div class="alert alert-danger" role="alert" v-bind:class="{'d-none': !hasError}">
                        This email address is already in database
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template> 

<script>
import DatePicker from 'vue2-datepicker';

    export default {
        components: { DatePicker },

        data() {
            return {
                newDrug: {'name': '', 'quantity': '', 'brand': 'NMRA', 'expireDate': '', 'email': ''},
                drugs: [],

                // setup calander
                lang: {
                    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
                    placeholder: {
                        date: 'Select Date',
                    }
                },

                hasError: false,
            }
        },

        methods: {
            addDrugs() {
                var input = this.newDrug;
                axios.post('/pharmacy/a/store', input).then((response) =>{
                    this.newUser = {'name': '', 'gender': 'Male', 'birthday': '', 'email': '', 'contact_number': '', 'user_role': 'Admin', 'slmc_number': '', 'qualification': ''}
                }).catch(err => {
                    this.hasError = true;
                });
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