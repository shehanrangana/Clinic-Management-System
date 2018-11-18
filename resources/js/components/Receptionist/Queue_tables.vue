<template>
  <div>
    <b-container class="bv-example-row">
      <b-row>
        <b-col class="b-col">
          <label for="queue1">08 - 09</label>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list0809"></b-table>
        </b-col>
        <b-col class="b-col">
          <label for="queue1">09 - 10</label>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list0910"></b-table>
        </b-col>
        <b-col class="b-col">
          <label for="queue1">10 - 11</label>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list1011"></b-table>
        </b-col>
        <b-col class="b-col-end">
          <label for="queue1">11 - 12</label>
          <b-table responsive small :fields="fields" @row-dblclicked="myRowClickHandler" striped hover :items="list1112"></b-table>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

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
    };
  },

  // This will fire with 'queuePushed' event
  created(){
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
    }
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
</style>

