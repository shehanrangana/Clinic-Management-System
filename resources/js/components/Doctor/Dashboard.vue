<template>
  <div>
    <!-- Patient details -->
    <div v-if="this.selectedPatient != '' && this.currentPatient != 0">
      <h5><b>Current Patient</b></h5><hr>
      <b-row class="text-center">
        <b-col>
          <h5 class="p-id-name">{{this.selectedPatient.name}}</h5>
        </b-col>
        <b-col>
          <h5 class="p-id-name"><strong>ID : </strong>{{this.selectedPatient.patient_id}}</h5>
        </b-col>
        <b-col>
          <h5 class="p-id-name"><strong>Birthday: </strong>{{this.selectedPatient.birthday}}</h5>
        </b-col>
      </b-row>
    </div>
    <b-row v-if="this.patientList != ''">
      <b-col cols="3">

        <h5><b>Queue List</b></h5><hr>
        <div v-if="patientList[currentPatient]">
          <b-row>
            <b-col>
              <b-button id="btn-queue-start" @click="expand(patientList[currentPatient])" size="sm">Call</b-button>  <!-- queue calling button -->
            </b-col>
            <b-col>
              <b-button id="btn-queue-start" @click="skip(patientList[currentPatient])" size="sm">Skip</b-button>  <!-- queue calling button -->
            </b-col>
          </b-row>
          <hr>
        </div>

        <div class="inner-div">
          <!-- Queue list -->
          <b-list-group>
            <b-list-group-item
              v-for="patient in patientList"
              :key="patient.index"
            >
              <h6>
                <b-badge variant="info" pil>{{ patient.number }}</b-badge>
                {{ patient.name }}
              </h6>
            </b-list-group-item>
          </b-list-group>
        </div>
      </b-col>
      <b-col cols="9">
        <b-row>
          <b-col>
            <h5><b>Form</b></h5>
            <hr>
            <div class="inner-div">
              <!-- Prescription entering form -->
              <b-form inline @submit.prevent="onSubmit()" @reset.prevent="onReset()">
                <b-form-select :options="drugList" v-model="form.drug"></b-form-select>
                <b-input type="number" placeholder="Quantity" v-model="form.quantity"/>
                <b-form-checkbox v-model="form.isLiquid">Liquid</b-form-checkbox>
                <b-button variant="info" size="sm" @click="addDrug()">Add</b-button>
                <b-form-textarea disabled
                     v-model="prescriptionText"
                     :rows="2"
                     :max-rows="6">
                </b-form-textarea>
                <!-- Comments -->
                <label>Comment</label>
                <b-form-textarea
                     v-model="comment"
                     :rows="2"
                     :max-rows="6">
                </b-form-textarea>
                <b-button v-if="this.selectedPatient !=''" id="btn-submit" type="submit" size="sm" variant="success">Submit</b-button>
                <b-button v-if="this.selectedPatient !=''" id="btn-reset" type="reset" size="sm" variant="danger">Reset</b-button>
              </b-form>
            </div>
          </b-col>
        </b-row>
        <b-row>
          <b-col>
            <div class="inner-div" v-if="this.patientHistory != ''">
              <h5><b>Patient Medical History</b></h5>
              <div v-for="oneDay in patientHistory" :key="oneDay.index">
                <b-card :sub-title="oneDay[0].date">
                  <p v-for="item in oneDay" :key="item.index">
                    <b>{{item.drug_name}} : {{item.quantity}}</b>
                    <br>
                    <i>{{item.comments}}</i>
                  </p>
                </b-card>
              </div>
            </div>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
    <b-row v-else>THERE ARE NO ACTIVE QUEUE</b-row>
  </div>
</template>

<script>
import { ListGroup } from "bootstrap-vue/es/components";
Vue.use(ListGroup);

import { Form } from "bootstrap-vue/es/components";
Vue.use(Form);

export default {
  data() {
    return {
      patientList: [],
      activeQueue: '',
      skippedPatientList: [],
      selectedPatient: [],
      currentPatient: 0,
      patientHistory: [],
      drugList: [{ text: 'Select One', value: null },],
      form: {
        drug: "",
        quantity: 0,
        isLiquid: false,
      },
      prescriptionText: '',
      comment: '',
      prescription: [],
      today: '',
    };
  },

  computed: {
    // Get drug list
    getDrugList() {
      axios.get("/doctor/dashboard/get_drug_list").then(response => {
        response.data.forEach(element => {
          this.drugList.push(element.name);
        });
      });
    },
  },

  created() {
    // This will fire whenever receptionist update queue
    window.Echo.channel("queue-channel").listen(".queue-started", event => {
      this.getQueueList();
    });
  },

  mounted() {
    this.getQueueList();
    this.getDrugList;
    this.today = new Date();
  },

  methods: {

    // Get patient list of current queue
    getQueueList() {
      axios.get("/doctor/dashboard/get_queue").then(response => {
        if (response.data != -1) {
          this.patientList = response.data.queue; // set patient queue
          this.currentPatient = response.data.active.current; // set current number of the queue
          this.activeQueue = response.data.active.timeslot; // set active queue
          this.selectedPatient = this.patientList[this.currentPatient-1]; // set selected patient
          // this.patientHistory = this.patientList[this.currentPatient-1]; // to show hostory when page refreshed
        }
      });
    },

    // Expand patient medical history
    expand(patient) {
      this.selectedPatient = patient;
      axios.get("/doctor/dashboard/patient_history", {params: { patient_id: patient.patient_id }}).then(response => {
        this.patientHistory = response.data.patient_history;
        this.currentPatient = response.data.current;
        // console.log(response.data.current);
      });
    },

    // Skip patient
    skip(patient) {
      // skippedPatientList
      // axios.get("/doctor/dashboard/patient_history", {params: { patient_id: patient.patient_id }}).then(response => {
      //   this.patientHistory = response.data.patient_history;
      //   this.currentPatient = response.data.current;
      //   // console.log(response.data.current);
      // });
    },

    // Add drug to array one by one
    addDrug() {
      if(this.form.drug != '' && this.form.quantity != 0){
        this.prescriptionText += this.form.drug + "; "; 
        this.prescription.push(this.form);
        this.form= {drug: "", quantity: 0, isLiquid: false};
      }
    },

    // Submit form
    onSubmit() {
      this.prescriptionText = '';
      axios.post('/doctor/dashboard/prescription_store', [this.selectedPatient.patient_id, this.prescription, this.comment, this.activeQueue]).then((response) =>{
        this.patientHistory.unshift(response.data); // add new element beginning of the array
      }).catch(err => {
        // console.log(err);
        alert("erro!");
      });
      this.prescription = [];
      this.comment = '';
    },

    // Reset form
    onReset() {
      this.form= {drug: "", quantity: 0, isLiquid: false}
      this.prescriptionText = '';
      this.comment = '';
    }
  }
};
</script>

<style>
.inner-div {
  padding: 10px 10px 10px 10px;
}
.col-4 {
  padding-left: 0px;
  padding-right: 0px;
}
.col-8 {
  padding-right: 0px;
}
.card {
  margin-bottom: 10px;
}
.badge {
  /* padding: 0.75em; */
  border-radius: 1rem;
  margin-right: 1em;
}
.list-group-item {
  padding: 5px 10px 5px 10px !important;
}
select {
  width: 50%!important;
  margin-right: auto;
}
input {
  width: 20%!important;
  margin-right: auto;
}
.custom-control {
  margin-right: auto;
}
textarea {
  width: 100%!important;
  margin: 5px 0px 5px 0px;
}
#btn-submit {
  width: 20%;
  margin-right: auto;
}
#btn-reset {
  width: 20%;
}
.p-id-name {
  background:deepskyblue;
  padding: 10px;
}
.text-center {
  margin-bottom: 50px!important;
}
#btn-queue-start {
  width: 100%;
  background: steelblue;
  border-color: steelblue;
}
</style>
