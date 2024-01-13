<template>
  <div>
    <Head title="Create Certified User"/>

    <div class="max-w-3xl p-8 mx-auto bg-white rounded-md shadow overflow-hidden">
      <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
        <flash-messages />
        <slot />
      </div>
      <h1 class="mb-8 text-3xl font-bold">
        <span class="text-indigo-400 font-medium"></span> Create Certified User
      </h1>
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <!-- User Information Section -->
          <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2"
                      label="First Name"/>

          <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2"
                      label="Last Name"/>
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email"/>
          <text-input v-model="form.phone_number" :error="form.errors.phone_number" class="pb-8 pr-6 w-full lg:w-1/2"
                      label="Phone Number"/>


          <select-input v-model="form.country_id" :error="form.errors.country_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Countries">
            <option disabled value="">Select a Country</option>
            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
          </select-input>


          <file-input v-model="form.photo" :error="form.errors.photo" class="pb-8 pr-6 w-full lg:w-1/2" type="file"
                      accept="image/*" label="Photo"/>

          <!-- Graduated University Section -->

          <select-input v-model="form.university_id" :error="form.errors.university_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Universities">
            <option disabled value="">Select a university</option>
            <option v-for="university in universities" :key="university.id" :value="university.id">{{ university.name }}</option>
          </select-input>

          <!-- Graduated Certificate File Section -->
          <file-input v-model="form.certificate_file" :error="form.errors.certificate_file"
                      class="pb-8 pr-6 w-full lg:w-1/2" type="file"
                      accept=".pdf" label="Graduated Certificate
            File"/>
          <text-input v-model="form.graduated_field" :error="form.errors.graduated_field" class="pb-8 pr-6 w-full lg:w-1/2" label="Graduated Field"/>

        </div>

        <!-- Price Table Section -->
        <div class="mb-4">
          <h2 class="text-xl font-bold mb-2">Prices:</h2>
          <table class="w-full border">
            <thead>
            <tr>
              <th class="border p-2">Description</th>
              <th class="border p-2">Tax</th>
              <th class="border p-2">Amount</th>
              <th class="border p-2">With Tax</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="price in prices">
              <td class="border p-2">{{price.name}}</td>
              <td class="border p-2">20%</td>
              <td class="border p-2">{{price.price}}</td>
              <td class="border p-2">{{ calculateTotalPrice(price.price) }}</td>
            </tr>
            </tbody>
          </table>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import FileInput from "@/Shared/FileInput.vue";
import FlashMessages from '@/Shared/FlashMessages'

import TrashedMessage from "@/Shared/TrashedMessage.vue";

export default {
  remember: 'form',
  components: {
    FlashMessages,
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  props: {
    countries: Object,
    universities:Object,
    prices:Object
  },
  data() {
    return {
      form: this.$inertia.form({
        first_name: '',
        last_name: '',
        email: '',
        country_id: '',
        phone_number: '',
        university_id: '',
        graduated_field: '',
        photo:null,
        certificate_file:null,
      }),
    };
  },
  methods: {

    calculateTotalPrice(price) {
      console.log(price+(100*0.20));
      return price+(100*0.20);
    },

    store() {
      this.form.post('/certified-user',)
    },

  },
};
</script>

<style>
/* Add your component-specific styles here */
</style>
