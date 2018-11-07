<template>
  <div>
    <!-- appointment table -->
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
              :items="items"
              
              :fields="fields"
              :current-page="currentPage"
              :per-page="perPage"
              :filter="filter"
              @filtered="onFiltered"
      >
        <template slot="actions" slot-scope="row">
          <b-button v-b-modal.modal-center size="sm" @click.stop="openModal(row.item)" class="mr-2">ADD</b-button>
        </template>

      </b-table>

      <!-- modal-center -->
      <b-modal id="modal-center" centered title= "Add to the queue" hide-footer >
        <b-form inline>
          <b-form-input v-model="queue.number" type="number" placeholder="List number"></b-form-input>
          <b-form-select id="timeslot" v-model="queue.timeslot" :options="timeslots" />
          <b-button variant="primary" @click.stop="addQueue()" :value="queue.timeslot">Save</b-button>
        </b-form>
      </b-modal>

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

export default {
  data () {
    return {
      items: [],
      sortBy: 'date',
      sortDesc: false,
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      filter: null,
      fields: [
        { key: 'date', sortable: true },
        { key: 'timeslot', sortable: true },
        { key: 'patient_id', sortable: true },
        { key: 'actions', sortable: false },
        'actions'
      ],

      // modal data
      queue: {'date': '', 'timeslot': '', 'patient_id': '', 'number': ''},
      selected: '',
      timeslots: [
        { value: '08-09', text: '08 - 09' },
        { value: '09-10', text: '09 - 10' },
        { value: '10-11', text: '10 - 11' },
        { value: '11-12', text: '11 - 12' }
      ],
    }
  },

  mounted() {
    this.totalRows = this.items.length;
    this.fetch();
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
    // To fetch each days appointment list
    fetch() {
      axios.get('/recept/queue/today-list').then((response) => {
        this.items = response.data;
        // console.log(response.data);
      })
    },

    // Filter appointment table
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },

    // Set data used in modal
    openModal(item) {
      // console.log(item);
      this.queue.date = item.date;
      this.queue.timeslot = item.timeslot;
      this.queue.patient_id = item.patient_id;

      this.getRecentNumber();
    },

    // Get recently added patient number
    getRecentNumber() {
      axios.get('/recept/queue/get_recent', {params: {timeslot: this.queue.timeslot}}).then( (response)=>{
        
          if(response.data != -1){
              this.queue.number = response.data + 1;
          }else{
              this.queue.number = 1;
          }
      });
    },

    // This method will call when a patient added to the queue
    addQueue(){
      axios.post('/recept/queue/add', this.queue).then((response) => {
        Event.$emit('queuePushed', response.data, this.queue.timeslot); // commiunicate with 'Queue_tables' 
        this.items = this.items.filter(function(el) {
          return el.patient_id != response.data.patient_id; 
        });
      });
      
      this.$root.$emit('bv::hide::modal','modal-center');
    },
  }
}
</script>

<style>
  body {
    /* this is why modal uses dynamic padding-right */
    padding-right: 0px!important;
  }
  .form-inline input, #timeslot {
    width: 140px!important;
    margin-right: 20px!important;
  }
  .form-inline button {
    width: 140px!important;
  }
</style>
