<template>
  <div class="inner-div">
    <b-row>
      <b-col>
        <b-card-group deck class="mb-3">
          <b-card bg-variant="primary" text-variant="white" class="text-center">
            <p class="card-text">Now : {{ panel1.current }}</p>
            <p class="card-text-next">Next : {{ nextNumber }}</p>
          </b-card>
        </b-card-group>
      </b-col>
      <b-col>
        <b-card-group deck class="mb-3">
          <b-card bg-variant="primary" text-variant="white" class="text-center">
            <p class="card-text">Now : {{ panel2.current }}</p>
            <p class="card-text-next">Next : {{ nextNumber }}</p>
          </b-card>
        </b-card-group>
      </b-col>
      <b-col>
        <b-card-group deck class="mb-3">
          <b-card bg-variant="primary" text-variant="white" class="text-center">
            <p class="card-text">Now : {{ panel3.current }}</p>
            <p class="card-text-next">Next : {{ nextNumber }}</p>
          </b-card>
        </b-card-group>
      </b-col>
      <b-col>
        <b-card-group deck class="mb-3">
          <b-card bg-variant="primary" text-variant="white" class="text-center">
            <p class="card-text">Now : {{ panel4.current }}</p>
            <p class="card-text-next">Next : {{ nextNumber }}</p>
          </b-card>
        </b-card-group>
      </b-col>
    </b-row>
  </div>
</template>

<script>

export default {
  data() {
    return {
      panel1: {'current': 0},
      panel2: {'current': 0},
      panel3: {'current': 0},
      panel4: {'current': 0},
      nextNumber: 0,
    };
  },

  created() {
    // This will fire whenever a doctor call a patient
    window.Echo.channel("number-update-channel").listen(".next-number-updated",event => {
        // console.log(event.next_number + " " + event.panel);
        switch (event.panel) {
          case 'panel_1':
            this.panel1 = {'current': event.next_number-1};
            break;
          case 'panel_2':
            this.panel2 = {'current': event.next_number-1};
            break;
          case 'panel_3':
            this.panel3 = {'current': event.next_number-1};
            break;
          case 'panel_4':
            this.panel4 = {'current': event.next_number-1};
            break;  
        }
        this.nextNumber = event.next_number;
      }
    );
  },

  mounted() {
    this.getStatus();
  },

  methods: {
    getStatus() {
      axios.get("/recept/dashboard/get_status").then(response => {
        this.panel1 = {'current': response.data.panel_1};
        this.panel2 = {'current': response.data.panel_2};
        this.panel3 = {'current': response.data.panel_3};
        this.panel4 = {'current': response.data.panel_4};
        this.nextNumber = (response.data.current == 0 ? 0:response.data.current+1);
      });
    }
  }
};
</script>

<style>
.card-text {
  font-size: xx-large;
}
.card-text-next {
  font-size: 48px;
}
.card {
  border-radius: 0px;
}
</style>
