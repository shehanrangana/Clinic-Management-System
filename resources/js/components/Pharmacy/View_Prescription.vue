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
            <!-- Show details button -->
            <b-button size="sm" @click.stop="row.toggleDetails">
                {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
            </b-button>

            <!-- Remove patient button -->
            <b-button size="sm" variant="danger" @click.stop="removeDrug(row.item)" class="mr-2">Remove</b-button>
        </template>
        <template slot="row-details" slot-scope="row">
            <b-card>
                <li>Quantity : {{ row.item.quantity }}</li>
                <li>Expire Date : {{ row.item.expire_date }}</li>
                <li>Supplier Email : {{ row.item.supplier_email }}</li>
            </b-card>
        </template>

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
  </div>
</template>

<script>
import { Table } from 'bootstrap-vue/es/components';
Vue.use(Table);

export default{
    data () {
        return {
            drugs: [],
            //user_role_name: '',
            sortBy: 'date',
            sortDesc: false,
            currentPage: 1,
            perPage: 10,
            totalRows: 0,
            pageOptions: [ 5, 10, 15 ],
            filter: null,
            fields: [
              { key: 'drug_name', sortable: true },
              { key: 'brand', sortable: false },
              { key: 'quantity', sortable: false },
              { key: 'expire_date', sortable: true },
              { key: 'supplier_email', sortable: false },
              
            ],
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
                // console.log(response.data);
                for(var i=0; i<response.data.length; i++){
                    response.data[i];

                }
                this.drugs = response.data;  
            })
        },

        removeDrug(drugs) {
            // console.log(user);
            axios.post('/pharmacy/addDrugs/remove/' + drugs.drug_id).then((response) =>{
                this.getDrugs();
            })
        },

        // Filter appointment table
        onFiltered (filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
    }
}
</script>
