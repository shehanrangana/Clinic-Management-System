<template>
    <div class="inner-div">
        <div class="container">
            <form @submit.prevent="getDetails()">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label for="name">Drug Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" v-model="newDrugs.name" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity of Drugs</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity of drugs" v-model="newDrugs.quantity" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="brand">Brand of Drugs</label>
                            <select class="form-control" id="brand" name="brand" v-model="newDrugs.brand" required>
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
                            <label for="date">Date</label>
                            <br>
                            <date-picker :lang="lang" name="date" v-model="newDrugs.date" style="font-family: 'Roboto', sans-serif;"></date-picker>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Supplier email address</label>
                    <input type="email" class="form-control" id="supplier_email" name="supplier_email" placeholder="Enter email" v-model="newDrugs.supplier_email" required>
                    
                </div>

                <button type="submit" class="btn btn-primary">Send</button>
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
                newDrugs: {'name': '', 'quantity': '', 'brand': 'NMRA', 'date': '', 'supplier_email': ''},
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
            getDetails() {
                var input = this.newDrugs;
                axios.post('/pharmacy/testmail', input).then((response) =>{
                    this.newDrugs = {'name': '','quantity':'' , 'brand': 'NMRA', 'date': '', 'supplier_email':''}
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