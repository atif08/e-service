<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/users">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('users') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('users') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">System Users</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/certified-users">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('certified-users') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('certified-users') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Applicants</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/prices">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('prices') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('prices') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Prices</div>
      </Link>
    </div>

  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
