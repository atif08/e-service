<template>
  <div>
    <Head title="Organizations" />
    <h1 class="mb-8 text-3xl font-bold">Certified Users</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>

    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">First Name</th>
            <th class="pb-4 pt-6 px-6">Last Name</th>
            <th class="pb-4 pt-6 px-6">Email</th>
            <th class="pb-4 pt-6 px-6">Status</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Phone</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/certified-users/${user.id}/edit`">
                {{ user.first_name }}
                <icon v-if="user.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/certified-users/${user.id}/edit`" tabindex="-1">
                {{ user.last_name }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/certified-users/${user.id}/edit`" tabindex="-1">
                {{ user.email }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/certified-users/${user.id}/edit`" tabindex="-1">
                {{ user.status }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/certified-users/${user.id}/edit`" tabindex="-1">
                {{ user.phone_number }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/certified-users/${user.id}/edit`" tabindex="-1">
                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="users.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No Users found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="users.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    users: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/certified-users', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
