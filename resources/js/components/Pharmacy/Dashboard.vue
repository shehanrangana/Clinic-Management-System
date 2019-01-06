<template>
  <div>
    <!-- Users table -->
    <h2>Today's Prescription</h2>
    <div class="inner-div">
      <b-row>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Filter" class="mb-0">
            <b-input-group>
              <b-form-input v-model="filterQue" placeholder="Type to Search" />
              <b-input-group-append>
                <b-btn :disabled="!filterQue" @click="filterQue = ''">Clear</b-btn>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
          
          
        </b-col>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Per page" class="mb-0">
            <b-form-select :options="pageOptionsQue" v-model="perPageQue" />
          </b-form-group>
        </b-col>
      </b-row>
      
      <!-- table-sorting.vue -->
      <b-table responsive hover 
              :sort-by.sync="sortByQue"
              :sort-desc.sync="sortDescQue"
              :items="prescriptionsQue"
              :fields="fieldsQue"
              :current-page="currentPageQue"
              :per-page="perPageQue"
              :filter="filterQue"
              @filtered="onFilteredQue"
      >

        <template slot="actions" slot-scope="row">
            <!-- Show details button -->
            <b-button size="sm" @click.stop="row.toggleDetails">
                {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
            </b-button>
            <b-button size="sm" variant="primary" @click.stop="updateQuantity(row.item)" class="mr-2">Issued </b-button>
            
            
        </template>
        <template slot="row-details" slot-scope="row">
            <b-card>
                <li>Drug Name : {{ row.item.drug_name }}</li>
                <li>Quantity : {{ row.item.quantity }}</li>
            </b-card>

          
        </template>
        

      </b-table>

      <!-- pagination -->
      <b-row>
        <b-col md="6" class="my-1">
          <b-pagination :total-rows="totalRowsQue" :per-page="perPageQue" v-model="currentPageQue" class="my-0" />
        </b-col>
      </b-row>
      <p>
        Sorting By: <b>{{ sortByQue }}</b>,
        Sort Direction: <b>{{ sortDescQue ? 'Descending' : 'Ascending' }}</b>
      </p>
    </div>

    <h2>Over Drugs</h2>
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
      </b-table>

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
    <h2>Expire Drugs</h2>
    <div class="inner-div">
      <b-row>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Filter" class="mb-0">
            <b-input-group>
              <b-form-input v-model="filterEx" placeholder="Type to Search" />
              <b-input-group-append>
                <b-btn :disabled="!filterEx" @click="filterEx = ''">Clear</b-btn>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
          
          
        </b-col>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Per page" class="mb-0">
            <b-form-select :options="pageOptionsEx" v-model="perPageEx" />
          </b-form-group>
        </b-col>
      </b-row>
      
      <!-- table-sorting.vue -->
      <b-table responsive hover 
              :sort-by.sync="sortByEx"
              :sort-desc.sync="sortDescEx"
              :items="expireDrugs"
              :fields="fieldsEx"
              :current-page="currentPageEx"
              :per-page="perPageEx"
              :filter="filterEx"
              @filtered="onFilteredEx"
      >
      </b-table>

      <!-- pagination -->
      <b-row>
        <b-col md="6" class="my-1">
          <b-pagination :total-rows="totalRowsEx" :per-page="perPageEx" v-model="currentPageEx" class="my-0" />
        </b-col>
      </b-row>
      <p>
        Sorting By: <b>{{ sortByEx }}</b>,
        Sort Direction: <b>{{ sortDescEx ? 'Descending' : 'Ascending' }}</b>
      </p>
    </div>
  </div>
</template>

<script>
import { Table } from 'bootstrap-vue/es/components';
Vue.use(Table);

export default{
    data () {
        return {
            prescriptionsQue: [],//patient precription list relavent current date
            drugs: [],//Over Drugs list
            expireDrugs:[],//expire Drugs list
            //patient precription list relavent current date
            sortByQue: 'date',
            sortDescQue: false,
            currentPageQue: 1,
            perPageQue: 10,
            totalRowsQue: 0,
            pageOptionsQue: [ 5, 10, 15 ],
            filterQue: null,
            fieldsQue: [
              { key: 'patient_id', sortable: true },
              { key: 'date', sortable: true },
              
              
              { key: 'actions', sortable: false },
              
            ],
            //Over Drugs list
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
              { key: 'supplier_email', sortable: false },
              
              
            ],
            //expire Drugs list
            sortByEx: 'date',
            sortDescEx: false,
            currentPageEx: 1,
            perPageEx: 10,
            totalRowsEx: 0,
            pageOptionsEx: [ 5, 10, 15 ],
            filterEx: null,
            fieldsEx: [
              { key: 'name', sortable: true },
              { key: 'brand', sortable: false },
              { key: 'quantity', sortable: true },
              { key: 'supplier_email', sortable: false },
              
              
            ],
        }
    },
  
    mounted() {
        this.getPrescriptions();
        this.getDrugs();
        this.getDrugsEx();
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
        getPrescriptions() {
            axios.get('pharmacy/dashboard/getPrescription').then((response) =>{
                console.log(response.data);
                
                this.prescriptionsQue = response.data;  
            })
        },

        updateQuantity(prescription) {
          axios.post('pharmacy/dashboard/updateQuantity', {'drug_name': prescription.drug_name, 'quantity':prescription.quantity}).then((response) =>{
        
                this.prescriptionQue = response.data;  
            })
          

        },
        getDrugs() {
            axios.get('/pharmacy/overDrug/show').then((response) =>{
                console.log(response.data);
                
                this.drugs = response.data;  
            })
        },
        getDrugsEx() {
            axios.get('/pharmacy/expireDrug/show').then((response) =>{
                console.log(response.data);
                
                this.expireDrugs = response.data;  
            })
        },


        
        //filter Prescription table relevent current date
        onFilteredQue (filteredItems) {
            
            this.totalRowsQue = filteredItems.length
            this.currentPageQue = 1
        },
        //filter Over drugs table
        onFiltered (filteredItems) {
            
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        //filter expire drugs table
        onFilteredEx (filteredItems) {
            
            this.totalRowsEx = filteredItems.length
            this.currentPageEx = 1
        },
    }
}
</script>
