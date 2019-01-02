<template>
    <div class="inner-div">
        <div class="container">
            <form @submit.prevent="addDrugs()">
                <div class="form-group">
                  <label for="drug_name">Drugs Name</label>
                  <input type="text" class="form-control" id="drug_name" name="drug_name" placeholder="Enter drug name" v-model="newDrug.drug_name" required>
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
                            <date-picker :lang="lang" name="expire_date" v-model="newDrug.expire_date" style="font-family: 'Roboto', sans-serif;"></date-picker>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Supplier Email address</label>
                    <input type="email" class="form-control" id="supplier_email" name="supplier_email" placeholder="Enter supplier email" v-model="newDrug.supplier_email" required>
                    
                </div>
                <div class="alert alert-danger" role="alert" v-bind:class="{'d-none': !hasError}">
                        This email address is already in database
                </div>
                <button type="submit"  @click.prevent="onSubmit"  class="btn btn-primary">Submit</button>
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
                form: {
        
                    drug_name: '',
                    quantity:'',
                    brand: null,
                    expire_date:'',
                    supplier_email:'',
                },
                newDrug: {'drug_name': '', 'quantity': '', 'brand': 'NMRA', 'expire_date': '', 'supplier_email': ''},
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
                axios.post('/pharmacy/addDrugs/store', input).then((response) =>{
                    this.newDrugs = {'drug_name': '','quantity':'' , 'brand': 'NMRA', 'expire_date': '', 'supplier_email':''}
                }).catch(err => {
                    this.hasError = true;
                });
            }
        },
        onSubmit (evt) {
      

              let data = new FormData()

              data.append('drug_name', this.form.drug_name)
              data.append('quantity', this.form.quantity)
              data.append('brand', this.form.brand)
              data.append('expire_date', this.form.expire_date)
              
              // console.log(data, this.form.file)
              axios.post('/pharmacy/addDrugs/store', data)
                .then(res => {
                  console.log(res)
                })
        
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