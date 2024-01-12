<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/certified-users">Certified Users</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore"> This user has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
          <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last Name" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.phone_number" :error="form.errors.phone_number" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
          <select-input v-model="form.status" :error="form.errors.status" class="pb-8 pr-6 w-full lg:w-1/2" label="Status">
            <option disabled value="">Select a Status</option>
            <option :selected="status.value" v-for="status in status_list" :key="status.value" :value="status.value">{{ status.name }}</option>
          </select-input>

          <a v-if="invoice" :href="invoice" target="_blank" class="underline-link">
            View Invoice
          </a>
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="can && !user.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete User</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update User</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    user: Object,
    status_list:Object,
    invoice:String,
    can:Boolean,
  },
  data() {
    return {
      form: this.$inertia.form({
        first_name: this.user.first_name,
        last_name: this.user.last_name,
        email: this.user.email,
        status: this.user.status,
        phone_number: this.user.phone_number,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/certified-users/${this.user.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(`/certified-users/${this.user.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this user?')) {
        this.$inertia.put(`/certified-users/${this.user.id}/restore`)
      }
    },
  },
}
</script>
<style scoped>
.underline-link {
  text-decoration: underline;
  margin-top: 34px;
  color: blue;
}
</style>
