<template>
  <div>
    <Head title="Prices" />
    <h1 class="mb-8 text-3xl font-bold">Prices</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Role:</label>
        <label class="block mt-4 text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/prices/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Price</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6">Price</th>
        </tr>
        <tr v-for="price in prices" :key="price.id" class="hover:bg-gray-100 focus-within:bg-gray-100">

          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/prices/${price.id}/edit`" tabindex="-1">
              {{ price.name }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/prices/${price.id}/edit`" tabindex="-1">
              {{ price.price }}
            </Link>
          </td>

          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/prices/${price.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="prices.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No prices found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    prices: Array,
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
        this.$inertia.get('/prices', pickBy(this.form), { preserveState: true })
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
