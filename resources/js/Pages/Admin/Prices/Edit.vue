<template>
  <div>
    <Head :title="`${form.name}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/prices">Prices</Link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h1>
    </div>
    <trashed-message v-if="price.deleted_at" class="mb-6" @restore="restore"> This user has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.price" :error="form.errors.price" class="pb-8 pr-6 w-full lg:w-1/2" label="Price" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!price.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete price</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Price</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    price: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.price.name,
        price: this.price.price,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/prices/${this.price.id}`, {
        onSuccess: () => this.form.reset(),
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this price?')) {
        this.$inertia.delete(`/prices/${this.price.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this price?')) {
        this.$inertia.put(`/prices/${this.price.id}/restore`)
      }
    },
  },
}
</script>
