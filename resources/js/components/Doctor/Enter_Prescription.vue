<template>
    <div class="inner-div">
        <div class="container">
            <form @submit.prevent="enterPrescription()">
                <div class="form-group">
                  <label for="patient_id">Patient ID</label>
                  <input type="text" class="form-control" id="patient_id" name="patient_id" placeholder="Enter patient id" v-model="newPrescription.patient_id" required>
                </div>
                <div class="form-group">
                  <label for="quantity">Quantity of Drugs</label>
                  <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter drug quantity" v-model="newPrescription.quantity" required>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="drug_name">Drug Name</label>
                            <select class="form-control" id="drug_name" name="drug_name" v-model="newPrescription.drug_name" required>
                                <option>Paracetamol</option>
                                <option>Acetaminophen</option>
                                <option>Calpol</option>
                                <option>Cetapyrin</option>
                                <option>Miglitol </option>
                                <option>Glucophage</option>
                                <option>Metformin Hydrochloride ER</option>
                                <option>Glumetza</option>
                                <option>Riomet</option>
                                <option>Fortamet</option>
                                <option>Actoplus</option>
                                <option>PrandiMet</option>
                                <option>Janumet</option>
                                <option>Jentadueto</option>
                                <option>Glucovance</option>
                                <option>Synjardy</option>
                            </select>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="expireDate">Date</label>
                            <br>
                            <date-picker :lang="lang" name="expire_date" v-model="newPrescription.date" style="font-family: 'Roboto', sans-serif;"></date-picker>
                        </div>
                    </div>
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
        
                    patient_id: '',
                    date:'',
                    drug_name: null,
                    quantity:'',
                    
                },
                newPrescription: {'patient_id': '', 'date': '', 'drug_name': 'Paracetamol', 'date': ''},
                prescriptions: [],

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
            enterPrescription() {
                var input = this.newPrescription;
                axios.post('/doctor/enterprescription/store', input).then((response) =>{
                    this.newPrescription = {'patient_id': '','date':'' , 'drug_name': 'Paracetamol', 'date': ''}
                }).catch(err => {
                    this.hasError = true;
                });
            }
        },
        onSubmit (evt) {
      

              let data = new FormData()

              data.append('patient_id', this.form.patient_id)
              data.append('date', this.form.date)
              data.append('drug_name', this.form.drug_name)
              data.append('date', this.form.date)
              
              // console.log(data, this.form.file)
              axios.post('/doctor/enterprescription/store', data)
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