<template>
    <div>
        <div >
            <!-- Users' data -->
            <b-row>
                <b-col class="inner-div" id="left-pane">
                    <b-img center thumbnail fluid src="https://picsum.photos/250/250/?image=52" alt="Thumbnail" />
                    <b-row>
                        <b-col class="id-name" cols="12">
                            <label for="id">ID : {{ user.user_id }}</label>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col class="id-name" cols="12">
                            <label for="name">{{ user.name }}</label>
                        </b-col>
                    </b-row>
                    <!-- Button section -->
                    <div class="btn-section">
                        <b-row class="text-center">
                            <b-col>
                                <b-button variant="secondary" v-on:click.stop="enableTextFields()">Edit profile</b-button>
                            </b-col>
                        </b-row>
                        <b-row class="text-center">
                            <b-col>
                                <b-button variant="secondary" v-on:click.stop="UpdateProfile()">Update</b-button>
                            </b-col>
                        </b-row>
                    </div>
                </b-col>
                <b-col cols="8" class="inner-div">
                    <div>
                        <b-form inline>
                            <label for="gender">Gender</label>
                            <b-input class="mb-2 mr-sm-2 mb-sm-0" id="gender" v-model="user.gender" disabled/>
                        </b-form>
                        <b-form inline>
                            <label for="birthday">Birthday</label>
                            <b-input class="mb-2 mr-sm-2 mb-sm-0" id="birthday" v-model="user.birthday" disabled/>
                        </b-form>
                        <b-form inline>
                            <label for="email">Email</label>
                            <b-input class="mb-2 mr-sm-2 mb-sm-0" id="email" v-model="user.email" :disabled="isDisabled"/>
                        </b-form>
                        <b-form inline>
                            <label for="contact_no">Contact Number</label>
                            <b-input class="mb-2 mr-sm-2 mb-sm-0" id="contact_no" v-model="user.contact_number" :disabled="isDisabled"/>
                        </b-form>
                        <b-form inline>
                            <label for="role">Role</label>
                            <b-input class="mb-2 mr-sm-2 mb-sm-0" id="role" v-model="user_role" disabled/>
                        </b-form>
                        <b-form inline>
                            <label for="slmc_number">SLMC Number</label>
                            <b-input class="mb-2 mr-sm-2 mb-sm-0" id="slmc_number" v-model="user.slmc_number" disabled/>
                        </b-form>
                        <b-form inline>
                            <label for="qualifications">Qualifications</label>
                            <b-form-textarea class="mb-2 mr-sm-2 mb-sm-0" id="qualifications" v-model="user.qualification" :rows="5" :disabled="isDisabled"></b-form-textarea>
                        </b-form>
                    </div>
                </b-col>
            </b-row>
        </div>
    </div>
    
</template>

<script>
import { Image } from 'bootstrap-vue/es/components';
Vue.use(Image);

import { FormTextarea } from 'bootstrap-vue/es/components';
Vue.use(FormTextarea);


export default {
    data() {
        return {
            user: [],
            user_role: '',
            isDisabled: true, // enable/disable text fields
        }
    },

    mounted() {
        this.user = window.auth_user[0];
        switch (this.user.user_role) {
            case 0:
                this.user_role = 'Admin';
                break;
            case 1:
                this.user_role = 'Receptionist';
                break;
            case 2:
                this.user_role = 'Doctor';
                break;
            case 3:
                this.user_role = 'Nurse';
                break;
            case 4:
                this.user_role = 'Lab Assistant';
                break;
            case 5:
                this.user_role = 'Pharmacist';
                break;
            default:
                break;
        }
    },

    methods: {
        // Enable text field
        enableTextFields() {
            this.isDisabled = false;
        },

        UpdateProfile() {
            axios.post(window.location.href + "/update", [this.user.user_id, this.user.email, this.user.contact_number, this.user.qualification]).then((response) =>{
                if(response.data == 1){
                    alert("Your profile successfully updated !");
                    swal("Done", "Your profile has been successfully updated !", "success");
                }else{
                    swal("Ooops !", "Nothing updated !", "info");
                }
            });
            this.isDisabled = true;
        },
    }
}
</script>

<style>
label {
    margin-right: auto;
}
input, textarea{
    width: 80%!important;
    border: none!important;
}
form {
    margin-bottom: 15px;
}
button {
    width: 200px;
    border-radius: 25px!important;
}
#left-pane {
    margin-right: 10px;
}
.id-name {
    text-align: center;
    margin-top: 20px;
    margin-bottom: -20px;
    font-size: 18px;
}
.btn-section {
    margin-top: 25px;
}
.text-center {
    margin: 10px 0px 10px 0px;
}
</style>
