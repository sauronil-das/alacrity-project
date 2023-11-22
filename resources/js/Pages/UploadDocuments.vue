<template>
    <div class="container mt-4">
      <h1 class="mb-4">Document Upload</h1>
      <form @submit.prevent="uploadDocument" class="mb-3">
        <div class="mb-3">
          <label for="brpFile" class="form-label">BRP Image</label>
          <input
            type="file"
            class="form-control"
            id="brpFile"
            ref="brpFile"
            accept="image/*"
            @change="handleBrpFileChange"
          />
        </div>
        <div class="mb-3">
          <label for="passportFile" class="form-label">Passport Image</label>
          <input
            type="file"
            class="form-control"
            id="passportFile"
            ref="passportFile"
            accept="image/*"
            @change="handlePassportFileChange"
          />
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
      </form>
    </div>
  </template>
  
  <script>
  import MainLayout from "@/Layouts/MainLayout.vue";
  import { Head, Link, router } from "@inertiajs/vue3";
  import axios from "axios";
  
  export default {
    components: {
      MainLayout,
      Head,
      Link,
    },
    data() {
      return {
        newLoan: {
          brpFile: null,
          passportFile: null,
        },
        errorMessage: "",
      };
    },
    methods: {
      uploadDocument() {
        const formData = new FormData();
        if (this.newLoan.brpFile) formData.append("brp", this.newLoan.brpFile);
        if (this.newLoan.passportFile) formData.append("passport", this.newLoan.passportFile);

        const url = route('api.documents.store');
        console.log(formData.toString());

      
  
        axios
          .post(url, formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            
            router.visit('confirmed'); 
          })
          .catch((error) => {
            this.errorMessage = error.response.data.message;
          });
      },
      handleBrpFileChange(event) {
        this.newLoan.brpFile = event.target.files[0];
      },
      handlePassportFileChange(event) {
        this.newLoan.passportFile = event.target.files[0];
      },
    },
  };
  </script>
  