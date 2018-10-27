<template>
    <div>
        <b-container class="bv-example-row">
            <b-row>
                <b-col class="b-col">
                    <label for="queue1">08 - 09</label>
                    <b-table responsive small @row-dblclicked="myRowClickHandler" striped hover :items="items"></b-table>
                </b-col>
                <b-col class="b-col">
                    <label for="queue1">09 - 10</label>
                    <b-table responsive small striped hover :items="items"></b-table>
                </b-col>
                <b-col class="b-col">
                    <label for="queue1">10 - 11</label>
                    <b-table responsive small striped hover :items="items"></b-table>
                </b-col>
                <b-col class="b-col-end">
                    <label for="queue1">11 - 12</label>
                    <b-table responsive small striped hover :items="items"></b-table>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
const items = [
  { Number: 1, ID: "0001" },
  { Number: 2, ID: "0002" },
  { Number: 3, ID: "0004" },
  { Number: 4, ID: "0010" }
];

export default {
  data() {
    return {
      items: items
    };
  },

  methods: {
    myRowClickHandler(record, index) {
      // 'record' will be the row data from items
      // `index` will be the visible row number (available in the v-model 'shownItems')
      // console.log(record, index);
      alert("Row clicked");
    }
  }
};
</script>

<style>
.b-col {
  margin: 5px 5px 5px 0px;
  background: #fafafa;
  /* border-radius: 10px; */
}
.b-col-end {
  margin: 5px 0px 5px 0px;
  background: #fafafa;
  /* border-radius: 10px; */
}
label {
  display: block;
  text-align: center;
  padding-top: 10px;
}
</style>

