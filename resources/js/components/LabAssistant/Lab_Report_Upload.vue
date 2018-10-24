<template>
  <div>
    <b-form @submit="onSubmit"  @reset="onReset" v-if="show">
      <!-- <b-form-group id="reportId"
                    label="Report Id :"
                    label-for="reportId"
                    >
        <b-form-input id="reportId"
                      type="text"
                      v-model="form.report_id"
                      required
                      >
        </b-form-input>
      </b-form-group> -->
      <b-form-group id="patientId"
                    label="Patient Id:"
                    label-for="patientId">
        <b-form-input id="patientId"
                      type="text"
                      v-model="form.patient_id"
                      required
                      >
        </b-form-input>
      </b-form-group>
      <b-form-group id="filename"
                    label="Choose a file :"
                    label-for="filename">
        <b-form-select id="filename"
                      :options="reports"
                      required
                      v-model="form.test">
        </b-form-select>
      </b-form-group>

      <div>

  <!-- Plain mode -->
              <b-form-file v-model="form.file" class="mt-3" plain></b-form-file>
              <div class="mt-3">Selected file: {{file && file.name}}</div>
      </div>
      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>
export default {
  data () {
    return {
      form: {
        
        patient_id: '',
        test: null,
        file:'',
      },
      reports: [
        { text: 'Select One', value: null },
        'Diabetes and the Fasting Plasma Glucose Test', 'The Casual Plasma Glucose Test', 'The Oral Glucose Tolerance Test', 'Diabetes and the Hemoglobin A1C Test','Other Diabetes Test'
      ],
      show: true
    }
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault();
      alert(JSON.stringify(this.form));
    },
    onReset (evt) {
      evt.preventDefault();
      /* Reset our form values */
      
      this.form.patient_id = '';
      this.form.test = null;
      this.form.file = '';
      /* Trick to reset/clear native browser form validation state */
      this.show = false;
      this.$nextTick(() => { this.show = true });
    }
  }
}
</script>

<!-- b-form-1.vue -->
