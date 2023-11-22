<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Await For Confirmation" />
  <MainLayout>
    <div class="alert alert-success" role="alert">
      <p class="mb-0">Thank You for Uploading Your Document.</p>
      <p>Your Account will be activated after Verification.</p>
    </div>
  </MainLayout>
</template>

<style scoped>
.alert-success {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
}
</style>