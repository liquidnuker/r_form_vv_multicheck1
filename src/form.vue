<template>
<div id="vee-form">
  <!-- name target -->
  <form class="form1" 
  id="form" name="form" @submit="validate($event)" method="POST">
    <!-- multi -->
    <small role="alert">{{ selectedMsg }} / Selected: {{ selected }}</small>
    <label for="item1">
      <input type="checkbox" name="item1" id="item1" value="item1" v-model="newsletter">
      item1
    </label>
    <label for="item2">
      <input type="checkbox" name="item2" id="item2" value="item2" v-model="newsletter">
      item2
    </label>
    <label for="item3">
      <input type="checkbox" name="item3" id="item3" value="item3" v-model="newsletter">
      item3
    </label>

    <br />
    <button type="submit">Submit</button>
    
  </form>
</div>
</template>
<script>
import axios from "axios";
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import { Validator } from 'vee-validate';
const validator = new Validator();

export default {
  data() {
      return {
        newsletter: [],
        selectedMsg: ""        

      };
    },
    mounted: function () {},
    methods: {
      handleFileUpload: function (e) {
        this.file = e.target.files[0];
        // this.file = this.$refs.file.files[0];
      },
      submitFile: function () {
        let formData = new FormData();
        
        formData.append("f_newsletter", this.newsletter);

        // let self = this;
        axios.post("./src/php/process.php", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        }).then(function (response) {
          console.log(response.data);
        }).catch(function () {
          console.log("error");
        });
      },
      validate: function (e) {
        e.preventDefault(); 

        // this.submitFile();

        this.$validator.validateAll().then(() => {
          console.log("$validator ok");
          // all inputs ok. proceed to validate multi checkbox
        })
        .then(() => {
          this.validateSelected();
        })
        .catch(() => {
          console.log("invalid");
          // return false;   
        });               
      },
      validateSelected: function() {
        if (this.newsletter.length < 2) {
          this.selectedMsg = "select 2 items";
        } else {
          this.selectedMsg = "";

          this.submitFile();
        }
      }
    }
}; 
</script>