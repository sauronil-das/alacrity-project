<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link, router, } from "@inertiajs/vue3";

export default {
  components: {
    MainLayout,
    Head,
    Link,
  },
  data() {
    return {
      newLoan: {
        name: '',
        amount: 0,
        email: '',
        password: '',
        phone: '',
        brp: '',
        passport_number: '',
        sort_code: '',
        bank_account: '',
      },

      creating: false,
      errorMessage: ''
    };
  },
  methods: {
    createLoan() {
      const storeUrl = route('loans.store');
      window.axios.post(storeUrl, this.newLoan)
        .then(response => {
          // Created!!! - where do we take the user??
          router.visit(route('UploadDocuments'));
          //router.visit(route('example2'));
        })
        .catch(error => {
          this.errorMessage = error.response.data.message;
        });
    }
  }
};
</script>

<template>
  <Head title="Create your loan" />

  <MainLayout>
    <h1>Apply for your loan</h1>
    
    <!-- <pre>{{ newLoan }}</pre> -->
    
    <div class="input-group mb-3">
    <span class="input-group-text">£</span>
    <input v-model="newLoan.amount" type="number" step="1" min="0" max="10000000" class="form-control" aria-label="Amount (to the nearest dollar)">
    <span class="input-group-text">.00</span>
    </div>

    <form @submit.prevent="createLoan">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input
          type="email"
          v-model="newLoan.email"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
        />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
      </div>

      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Name</label>
        <input
          type="text"
          v-model="newLoan.name"
          id="disabledTextInput"
          class="form-control"
        />
        </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input
          type="password"
          v-model="newLoan.password"
  
          class="form-control"
          id="exampleInputPassword1"
        />
      </div>
      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Phone</label>
        <input
          type="number"
          v-model="newLoan.phone"
          id="disabledTextInput"
          class="form-control"
        />
      </div>
      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">BRP Number</label>
        <input
          v-model="newLoan.brp"
          type="text"
          id="disabledTextInput"
          class="form-control"
        />
      </div>
      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Passport Number</label>
        <input
          v-model="newLoan.passport_number"
          type="text"
          id="disabledTextInput"
          class="form-control"
        />
      </div>
      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Sort Code</label>
        <input
          v-model="newLoan.sort_code"
          type="text"
          id="disabledTextInput"
          class="form-control"
        />
      </div>
      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Account Number</label>
        <input
          v-model="newLoan.bank_account"
          type="number"
          id="disabledTextInput"
          class="form-control"
        />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>

      <div v-if="errorMessage" class="alert alert-warning">
        {{ errorMessage }}
      </div>
    </form>
  </MainLayout>
</template>
