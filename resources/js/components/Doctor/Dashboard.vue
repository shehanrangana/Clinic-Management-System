<template>
  <div>
    <!-- Panel selection -->
    <div class="switch">
      <toggle-button class="toggle-start" v-model="value[0]"  name="queue2" v-bind:disabled="disable[0]" @change='activePanel(0)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'PANEL 1'}" :width="150" :height="30"/>
      <toggle-button class="toggle-start" v-model="value[1]"  name="queue2" v-bind:disabled="disable[1]" @change='activePanel(1)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'PANEL 2'}" :width="150" :height="30"/>
      <toggle-button class="toggle-start" v-model="value[2]"  name="queue2" v-bind:disabled="disable[2]" @change='activePanel(2)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'PANEL 3'}" :width="150" :height="30"/>
      <toggle-button class="toggle-start" v-model="value[3]"  name="queue2" v-bind:disabled="disable[3]" @change='activePanel(3)' color="#82C7EB" :sync="true" :labels="{checked: 'Started', unchecked: 'PANEL 4'}" :width="150" :height="30"/>
    </div>
    <hr>
    <!-- Patient details -->
    <div v-if="this.selectedPatient != ''">
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
        <div>
          <b-row>
            <b-col>
              <b-button variant="info" id="btn-queue-start" @click="expand()" size="sm">Call</b-button>  <!-- queue calling button -->
            </b-col>
            <!-- <b-col>
              <b-button id="btn-queue-start" @click="skip(patientList[currentPatient])" size="sm">Skip</b-button>  
            </b-col> -->
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
            <h5><b>Prescription</b></h5>
            <hr>
            <div class="inner-div">
              <!-- Prescription entering form -->
              <label>Drug selection</label>
              <b-form inline @submit.prevent="onSubmit()" @reset.prevent="onReset()">
                <b-form-select :options="drugList" v-model="form.drug"></b-form-select>
                <b-input type="number" placeholder="Dose" v-model="form.quantity"/>
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
              <div>
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
            </div>
            <div v-else>
              <!-- <b-card :sub-title="">
                    <p v-for="item in oneDay" :key="item.index">
                      <b>{{item.drug_name}} : {{item.quantity}}</b>
                      <br>
                      <i>{{item.comments}}</i>
                    </p>
                </b-card> -->
            </div>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
    <b-row v-else><h5><strong></strong></h5></b-row>
  </div>
</template>

<script>
import { ListGroup } from "bootstrap-vue/es/components";
Vue.use(ListGroup);

import { Form } from "bootstrap-vue/es/components";
Vue.use(Form);

import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

import swal from 'sweetalert';

export default {
  data() {
    return {
      // toggle button data 
      disable: [false, false, false, false],
      value: [false, false, false, false],
      activatedPanel: '',
      
      patientList: [],
      activeQueue: '',
      skippedPatientList: [],
      selectedPatient: [],
      currentPatient: 0,
      nexttPatient: 0,
      patientHistory: [],
      drugList: [{ text: 'Select One', value: null },],
      form: {
        drug: "",
        quantity: '',
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

    // This will fire whenever a doctor call a patient
    window.Echo.channel("number-update-channel").listen(".next-number-updated", event => {
      this.nextPatient = event.next_number;
    });

    // Show activated panel
    axios.get('/doctor/dashboard/is_active_panel').then((response) =>{
      if(response.data != 0){
        // disable all switches
        this.disable = [true, true, true, true];

        // switch on relevant switch
        if(response.data.isActive){
          switch (response.data.panel) {
          case 'panel_1':
            this.value[0] = true;
            this.activatedPanel = 'panel_1';
            break;
          case 'panel_2':
            this.value[1] = true;
            this.activatedPanel = 'panel_2';
            break;
          case 'panel_3':
            this.value[2] = true;
            this.activatedPanel = 'panel_3';
            break;
          case 'panel_4':
            this.value[3] = true;
            this.activatedPanel = 'panel_4';
            break;
          }
        }  
      }    
    });
  },

  mounted() {
    this.getQueueList();
    this.getDrugList;
    this.today = new Date();
  },

  methods: {
    
    // notify relevant panel's activation
    activePanel(id) {
      // disable all the switches
      this.disable = [true, true, true, true];
      this.value[id] = true;

      axios.post('/doctor/dashboard/active_panel', {'activated_panel': id}).then((response) =>{
        swal("PANEL "+ (id+1) + " IS STARTED", "", "info");
        this.activatedPanel = response.data;
      }).catch(err => {
        console.log(err);
      });
    },

    // Get patient list of current queue and selected patient 
    getQueueList() {
      axios.get("/doctor/dashboard/get_queue").then(response => {
        if (response.data != -1) {
          this.patientList = response.data.queue; // set patient queue
          if(response.data.panel == this.activatedPanel){
            this.currentPatient = response.data.active[this.activatedPanel]; // set current number of the queue
          }
          this.nextPatient = response.data.active.current+1; // set next number of the queue
          this.activeQueue = response.data.active.timeslot; // set active queue
          this.patientList.forEach(element => {
            if(this.currentPatient == element.number){
              this.selectedPatient = element;
            }
          });
        }
      });
    },

    // Expand patient medical history
    expand() {
      this.patientList.forEach(element => {
        if(this.nextPatient == element.number){
          this.selectedPatient = element;
        }
      });

      axios.get("/doctor/dashboard/patient_history", {params: { patient_id: this.selectedPatient.patient_id, number: this.selectedPatient.number }}).then(response => {
        this.patientHistory = response.data.patient_history;
        this.nextPatient = response.data.next_number;
        // console.log(this.patientHistory);
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
        swal("Done", "Prescription successfully uploaded", "success");
        this.patientHistory.unshift(response.data); // add new element beginning of the array
        this.recentComment = response.data.comment;
      }).catch(err => { // alert("Prescription is already uploaded!");
        swal("Error!", "Prescription is already uploaded!", "error");
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
  background:white;
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
.switch {
  text-align: center;
}
</style>
