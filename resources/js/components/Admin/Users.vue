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
              :items="users"
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
            <b-button size="sm" variant="danger" @click.stop="removeUser(row.item)" class="mr-2">Remove</b-button>
        </template>
        <template slot="row-details" slot-scope="row">
            <b-card>
                <li>Birthday : {{ row.item.birthday }}</li>
                <li>Qulifications : {{ row.item.qualification }}</li>
                <li>SLMC Number : {{ row.item.slmc_number }}</li>
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
            users: [],
            user_role_name: '',
            sortBy: 'date',
            sortDesc: false,
            currentPage: 1,
            perPage: 10,
            totalRows: 0,
            pageOptions: [ 5, 10, 15 ],
            filter: null,
            fields: [
              { key: 'name', sortable: true },
              { key: 'gender', sortable: false },
              { key: 'email', sortable: false },
              { key: 'contact_number', sortable: false },
              { key: 'user_role', sortable: true },
              { key: 'actions', sortable: false },
            ],
        }
    },
  
    mounted() {
        this.getUsers();
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
        getUsers() {
            axios.get('/admin/users/show').then((response) =>{
                // console.log(response.data);
                for(var i=0; i<response.data.length; i++){
                    if(response.data[i].user_role == 0){
                        response.data[i].user_role = "Admin"
                    }else if(response.data[i].user_role == 1){
                        response.data[i].user_role = "Receptionist"
                    }else if(response.data[i].user_role == 2){
                        response.data[i].user_role = "Doctor"
                    }else if(response.data[i].user_role == 3){
                        response.data[i].user_role = "Nurse"
                    }else if(response.data[i].user_role == 4){
                        response.data[i].user_role = "Lab Assistant"
                    }else if(response.data[i].user_role == 5){
                        response.data[i].user_role = "Pharmacist"
                    }
                }
                this.users = response.data;  
            })
        },

        removeUser(user) {
            // console.log(user);
            axios.post('/admin/users/remove/' + user.user_id).then((response) =>{
                this.getUsers();
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
