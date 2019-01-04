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
              :items="lab_reports"
              :fields="fields"
              :current-page="currentPage"
              :per-page="perPage"
              :filter="filter"
              @filtered="onFiltered"
      >

        <template slot="actions" slot-scope="row">
            
            <b-button type="button" :href="'/storage/' + row.item.file">View</b-button>
            <b-button size="sm" variant="danger" @click.stop="removeReport(row.item)" class="mr-2">Remove</b-button>
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
            lab_reports: [],
           
            sortBy: 'date',
            sortDesc: false,
            currentPage: 1,
            perPage: 10,
            totalRows: 0,
            pageOptions: [ 5, 10, 15 ],
            filter: null,
            fields: [
              { key: 'patient_id', sortable: true },
              { key: 'test', sortable: false },
              

              { key: 'actions', sortable: false },
              
            ],
            url: '',
        }
    },
  
    mounted() {
        this.getReport();
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
        getReport() {
            axios.get('/lab/upload/show').then((response) =>{
                this.lab_reports = response.data;  
                console.log(this.lab_reports);
            })
        },

        removeReport(lab_reports) {
            // console.log(user);
            axios.post('/lab/upload/remove/' + lab_reports.report_id).then((response) =>{
                this.getReport();
            })
        },

        getPdf(report_id) {
            // console.log(user);
            // axios.get('/lab/upload/getReport', {params: {report_id: report_id}}).then((response) =>{
            //     this.getReport();
            // })
            // console.log(report_id);
            this.url = report_id;
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
