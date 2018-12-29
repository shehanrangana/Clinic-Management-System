<template>
  <div>
    <b-container class="bv-example-row">
      <b-row>
        <b-col class="b-col">
          <label for="queue1">08 - 09</label>
          <!-- Toggle button for start/stop queue1 -->
          <toggle-button class="toggle-start" v-model="value[0]"  name="queue1" v-bind:disabled="disable[0]" @change='changeState(0)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'Stopped'}" :width="80"/>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list0809"></b-table>
        </b-col>
        <b-col class="b-col">
          <label for="queue2">09 - 10</label>
          <!-- Toggle button for start/stop queue2 -->
          <toggle-button class="toggle-start" v-model="value[1]"  name="queue2" v-bind:disabled="disable[1]" @change='changeState(1)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'Stopped'}" :width="80"/>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list0910"></b-table>
        </b-col>
        <b-col class="b-col">
          <label for="queue3">10 - 11</label>
          <!-- Toggle button for start/stop queue3 -->
          <toggle-button class="toggle-start" v-model="value[2]"  name="queue3" v-bind:disabled="disable[2]" @change='changeState(2)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'Stopped'}" :width="80"/>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list1011"></b-table>
        </b-col>
        <b-col class="b-col-end">
          <label for="queue4">11 - 12</label>
          <!-- Toggle button for start/stop queue4 -->
          <toggle-button class="toggle-start" v-model="value[3]"  name="queue4" v-bind:disabled="disable[3]" @change='changeState(3)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'Stopped'}" :width="80"/>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list1112"></b-table>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
// Import toggle button
import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

export default {
  data() {
    return {
      list0809: [],
      list0910: [],
      list1011: [],
      list1112: [],
      fields: [
        { key: 'number'},
        { key: 'patient_id'}
      ],
      // toggle button data 
      disable: [true, true, true, true],
      value: [false, false, false, false],
    };
  },

  created(){
    // This will fire with 'queuePushed' event
    Event.$on('queuePushed',  (addedPatient, timeslot) => {
      if(timeslot == '08-09'){
        this.list0809.push(addedPatient);
      }else if(timeslot == '09-10'){
        this.list0910.push(addedPatient);
      }else if(timeslot == '10-11'){
        this.list1011.push(addedPatient);
      }else if(timeslot == '11-12'){
        this.list1112.push(addedPatient);
      }
    });

    // Get active queue
    axios.get('/recept/queue/active-queue').then((response) =>{
      this.value[response.data] = true; // switch on active queue
      if(response.data == -1){ // if there is no active queue
        this.disable = [false, false, false, false]; // enable all the switches
      }else{
        this.disable[response.data] = false; // enable only active queue switch
      }
    });
  },

  mounted() {
    this.fetch();
  },

  methods: {
    // Double click event
    myRowClickHandler(record, index) {
      // 'record' will be the row data from items
      // `index` will be the visible row number (available in the v-model 'shownItems')
      // console.log(record, index);
      alert("Row clicked");
    },

    // This method will return queue details
    fetch: function(){
      return axios.get('/recept/queue/numbers').then((response) => {
        this.list0809 = response.data[0];
        this.list0910 = response.data[1];
        this.list1011 = response.data[2];
        this.list1112 = response.data[3];
      })
    },

    // Change state of the queue
    changeState(id) {
      if(this.value[id]){
        this.disable = [true, true, true, true];
        this.disable[id] = false;

        // Send queue data to the database
        var total = 0;
        switch (id) {
          case 0:
            total = this.list0809.length;
            break;
          case 1:
            total = this.list0910.length;
            break;
          case 2:
            total = this.list1011.length;
            break;
          case 3:
            total = this.list1112.length;
            break;
          default:
            break;
        }

        this.queueDetails = [id, total, 0, 1];
        axios.post('/recept/queue/start', this.queueDetails).then((response) =>{
          alert("Queue started");
        }).catch(err => {
          this.value = [false, false, false, false]; // if error occured all the switches reset
          this.disable = [false, false, false, false]; 
          alert("This queue has been completed");
        });
      }else{
        this.disable = [false, false, false, false];
        // this.disable[id] = true; // permenetly disable finished queue switch
        axios.post('/recept/queue/stop', [id]).then((response) =>{
          console.log(response.data);
        }).catch(err => {
            this.hasError = true;
        });
      }
    },
  }
};
</script>

<style>
.b-col {
  margin: 5px 5px 5px 0px;
  background: #fafafa;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}
.b-col-end {
  margin: 5px 0px 5px 0px;
  background: #fafafa;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}
label {
  display: block;
  /* background-color:#0064b7; */
  font-size: 24px;
  color: #13aa4d;
  text-align: center;
  margin-top: 10px;
  /* border-radius: 8px; */
  /* border: 2px solid red; */
}
.toggle-start {
  display: table!important;
  margin-left: auto;
  margin-right: auto;
}
</style>

