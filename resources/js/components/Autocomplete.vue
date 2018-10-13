<template>
    <div>
        <input type="text" placeholder="what are you looking for?" v-model="query" v-on:keyup="autoComplete()" class="form-control">
        <ul class="list-group">
            <li v-for="result in results" @click="test()">
                {{ result.name }}
            </li>
            
        </ul>

        

    </div>
</template>

<script>
export default {
  data() {
    return {
      query: "",
      results: [],
      result: "",
      arr: []
    };
  },
  methods: {
    autoComplete() {
      this.results = [];
      axios
        .get("/recept/queue/search", { params: { query: this.query } })
        .then(response => {
          this.results = response.data;
        });
    },

    test() {
        // this.arr.push(this.result);
        console.log(this.result);
    }
  }
};
</script>