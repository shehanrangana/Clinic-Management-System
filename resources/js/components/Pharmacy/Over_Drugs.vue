<template>
  <div>
    <!-- Users table -->
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
            drugs: [],
            expireDrugs:[],
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
        getDrugs() {
            axios.get('/pharmacy/overDrug/show').then((response) =>{
                console.log(response.data);
                // for(var i=0; i<response.data.length; i++){
                //     response.data[i];

                // }
                this.drugs = response.data;  
            })
        },
        getDrugsEx() {
            axios.get('/pharmacy/expireDrug/show').then((response) =>{
                console.log(response.data);
                // for(var i=0; i<response.data.length; i++){
                //     response.data[i];

                // }
                this.expireDrugs = response.data;  
            })
        },

        

        // Filter appointment table
        onFiltered (filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        onFilteredEx (filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRowsEx = filteredItems.length
            this.currentPageEx = 1
        },
    }
}



</script>
