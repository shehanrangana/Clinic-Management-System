<template>
  <div>
    <!-- Users table -->
    <div class="inner-div">
      <b-row>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Filter" class="mb-0">
            <b-input-group>
              <b-form-input v-model="filter" placeholder="Type to Search" />
              <b-input-group-append>
                <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
          
          
        </b-col>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Per page" class="mb-0">
            <b-form-select :options="pageOptions" v-model="perPage" />
          </b-form-group>
        </b-col>
      </b-row>
      
      <!-- table-sorting.vue -->
      <b-table responsive hover 
              :sort-by.sync="sortBy"
              :sort-desc.sync="sortDesc"
              :items="drugs"
              :fields="fields"
              :current-page="currentPage"
              :per-page="perPage"
              :filter="filter"
              @filtered="onFiltered"
      >

        <template slot="actions" slot-scope="row">
            <b-button size="sm" variant="primary" @click.stop="updateDrug(row.item)" class="mr-2">Update</b-button>

            <!-- Remove patient button -->
            <b-button size="sm" variant="danger" @click.stop="removeDrug(row.item)" class="mr-2">Remove</b-button>
        </template>
        

      </b-table>
      <!-- <b-modal id="modal-center" centered title= "Update Drugs" hide-footer >
        <b-form inline>
          <b-form-input v-model="updatelist.quantity" type="number" placeholder="Quantity"></b-form-input>
          <b-form-input v-model="updatelist.expire_date" type="text" placeholder="Date"></b-form-input>
           
          
                        <b-form-input>
                            
                            <date-picker :lang="lang" name="expire_date" v-model="updatelist.expire_date" style="font-family: 'Roboto', sans-serif;"></date-picker>
                        </b-form-input>
                    <div class="col">
                        <div class="form-group">
                            <label for="expire_date">Expire Date</label>
                            <br>
                            <date-picker :lang="lang" name="expire_date" v-model="updatelist.expire_date" style="font-family: 'Roboto', sans-serif;"></date-picker>
                        </div>
                    </div>
          
          <b-button variant="primary" @click.stop="update()" :value="updatelist.quantity">Save</b-button>
        </b-form>
      </b-modal> -->

      <!-- pagination -->
      <b-row>
        <b-col md="6" class="my-1">
          <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
        </b-col>
      </b-row>
      <p>
        Sorting By: <b>{{ sortBy }}</b>,
        Sort Direction: <b>{{ sortDesc ? 'Descending' : 'Ascending' }}</b>
      </p>
    </div>
  </div>

   
</template>

<script>
import DatePicker from 'vue2-datepicker';
import { Table } from 'bootstrap-vue/es/components';
Vue.use(Table);

export default{
  components: { DatePicker },
    data () {
        return {
            drugs: [],
            sortBy: 'date',
            sortDesc: false,
            currentPage: 1,
            perPage: 10,
            totalRows: 0,
            pageOptions: [ 5, 10, 15 ],
            filter: null,
            fields: [
              { key: 'name', sortable: true },
              { key: 'brand', sortable: false },
              { key: 'quantity', sortable: false },
              { key: 'expire_date', sortable: true },
              { key: 'supplier_email', sortable: false },
              { key: 'actions', sortable: false },
              
            ],
            updatelist: {'quantity': '', 'expire_date': ''},
            selected: '',
            // lang: {
            //         days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            //         months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            //         pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
            //         placeholder: {
            //             date: 'Select Date',
            //         }
            // },

        }
    },
  
    mounted() {
        this.getDrugs();
    },

    computed: {
        sortOptions () {
          // Create an options list from our fields
          return this.fields
            .filter(f => f.sortable)
            .map(f => { return { text: f.label, value: f.key } })
        },
    },

    methods: {
        getDrugs() {
            axios.get('/pharmacy/addDrugs/show').then((response) =>{
                console.log(response.data);
                
                this.drugs = response.data;  
            })
        },

        removeDrug(drugs) {
            // console.log(user);
            axios.post('/pharmacy/addDrugs/remove/' + drugs.drug_id).then((response) =>{
                this.getDrugs();
            })
        },

          // updateDrug(item) {
          //   // console.log(item);
          //   this.updatelist.quantity = item.quantity;
          //   this.updatelist.expire_date = item.expire_date;
            
          //   this.updateDru();
          // },
          // // Get recently added patient number
          // updateDru() {
          //   axios.get('/pharmacy/drusUpdate', {params: this.updatelist.quantity ,this.updatelist.expire_date}).then( (response)=>{
          //     console.log(response.data);
          //     this.updatelist = response.data;
                
          //   });
          // },
          // update(){
          //   axios.post('/pharmacy/drusUpdate/store', this.updatelist).then((response) => {
          //     // Event.$emit('queuePushed', response.data, this.updatelist.quantity ,this.updatelist.expire_date); 
          //     console.log(response.data);
          //     this.updatelist = response.data; 
              
          //   });
      
          //   this.$root.$emit('bv::hide::modal','modal-center');
          // },

        // Filter appointment table
        onFiltered (filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
    }
}



</script>
