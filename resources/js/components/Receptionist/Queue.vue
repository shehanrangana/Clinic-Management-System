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

      <b-table responsive hover 
              :sort-by.sync="sortBy"
              :sort-desc.sync="sortDesc"
              :items="items"
              :items-provider="fetch"
              :fields="fields"
              :current-page="currentPage"
              :per-page="perPage"
              :filter="filter"
              @filtered="onFiltered"
      >
        <template slot="options" slot-scope="data">
          <!-- <b-button size="sm" @click.stop="">

          </b-button> -->
          <b-dropdown id="ddown-left" size="sm" left text="Add to..." variant="primary" class="m-2">
            <b-dropdown-item href="#">09-10</b-dropdown-item>
            <b-dropdown-item href="#">10-11</b-dropdown-item>
            <b-dropdown-item href="#">11-12</b-dropdown-item>
          </b-dropdown>
        </template>

      </b-table>

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

const items = [];

export default {
  data () {
    return {
      items: items,
      sortBy: 'date',
      sortDesc: false,
      currentPage: 1,
      perPage: 5,
      totalRows: items.length,
      pageOptions: [ 5, 10, 15 ],
      filter: null,
      fields: [
        { key: 'date', sortable: true },
        { key: 'timeslot', sortable: true },
        { key: 'patient_id', sortable: true },
        { key: 'options', sortable: false },
        'options'
      ],
    }
  },

  mounted() {
      this.fetch();
  },

  computed: {
    sortOptions () {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => { return { text: f.label, value: f.key } })
    }
  },

  methods: {
    fetch() {
      return axios.get('/recept/queue/today-list').then((response) => {
        this.items = response.data;
        // console.log(response.data);
      })
    },

    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    }
  }
}
</script>

<!-- table-sorting.vue -->

<style>
  .m-2 {
    margin: 0rem!important;
  }
</style>
