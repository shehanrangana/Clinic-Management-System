<template>
  <div>
    <!-- patients table -->
    <div class="inner-div">
      <b-row>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Filter" class="mb-0">
            <b-input-group>
              <b-form-input v-model="filter" placeholder="Type to Search"/>
              <b-input-group-append>
                <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>
        <b-col md="6" class="my-1">
          <b-form-group horizontal label="Per page" class="mb-0">
            <b-form-select :options="pageOptions" v-model="perPage"/>
          </b-form-group>
        </b-col>
      </b-row>

      <!-- table-sorting.vue -->
      <b-table
        responsive
        hover
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        :items="patients"
        :fields="fields"
        :current-page="currentPage"
        :per-page="perPage"
        :filter="filter"
        @filtered="onFiltered"
      >
        <template slot="actions" slot-scope="row">
          <!-- Show details button -->
          <b-button
            size="sm"
            @click.stop="row.toggleDetails"
          >{{ row.detailsShowing ? 'Hide' : 'Show' }} Details</b-button>

          <!-- Remove patient button -->
          <!-- <b-button
            size="sm"
            variant="danger"
            @click.stop="removePatient(row.item)"
            class="mr-2"
          >Remove</b-button> -->
        </template>
        <template slot="row-details" slot-scope="row">
          <b-card>
            <li>NIC : {{ row.item.nic }}</li>
            <li>Address Line 1 : {{ row.item.address_line_1 }}</li>
            <li>Address Line 2 : {{ row.item.address_line_2 }}</li>
            <li>Address Line 3 : {{ row.item.address_line_3 }}</li>
          </b-card>
        </template>
      </b-table>

      <!-- pagination -->
      <b-row>
        <b-col md="6" class="my-1">
          <b-pagination
            :total-rows="totalRows"
            :per-page="perPage"
            v-model="currentPage"
            class="my-0"
          />
        </b-col>
      </b-row>
      <p>
        Sorting By:
        <b>{{ sortBy }}</b>,
        Sort Direction:
        <b>{{ sortDesc ? 'Descending' : 'Ascending' }}</b>
      </p>
    </div>
  </div>
</template>

<script>
import { Table } from "bootstrap-vue/es/components";
Vue.use(Table);

export default {
  data() {
    return {
      patients: [],
      sortBy: "date",
      sortDesc: false,
      currentPage: 1,
      perPage: 10,
      totalRows: 0,
      pageOptions: [5, 10, 15],
      filter: null,
      fields: [
        { key: "patient_id", sortable: true },
        { key: "name", sortable: true },
        { key: "gender", sortable: false },
        { key: "birthday", sortable: true },
        { key: "contact_number", sortable: false },
        { key: "guardian_number", sortable: false },
        { key: "actions", sortable: false }
      ]
    };
  },

  mounted: function mounted() {
    this.getPatients();
  },

  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key };
        });
    }
  },

  methods: {
    getPatients() {
      axios.get("/doctor/patients/show").then(response => {
        this.patients = response.data;
        // console.log(response.data);
      });
    },
    // removePatient(patient) {
    //   swal({
    //     title: "Are you sure?",
    //     text:
    //       "Once deleted, you will not be able to restore this patient details!",
    //     icon: "warning",
    //     buttons: true,
    //     dangerMode: true
    //   }).then(willDelete => {
    //     if (willDelete) {
    //       axios.post("/admin/patients/remove/" + patient.patient_id).then(response => {
    //         swal("Selected patient has been removed !", {
    //           icon: "success"
    //         });
    //         this.getPatients();
    //       }).catch(err => {
    //         swal("Error!", "This patient has an appointment", "error");
    //       });
    //     } else {
    //       swal("Patient not removed !");
    //     }
    //   });
    // },
    // Filter appointment table
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  }
};
</script>
