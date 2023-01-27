<script setup>
import { defineProps, computed } from 'vue';
import { useStoreUrl } from '../stores/url'

const { name, linkName } = defineProps({
  name: {
    type: String,
    default: "アンサー",
  },
  linkName: {
    type: String,
    default: "/answer/recent",
  },
})

const isActiveClass = computed(() => {
  const linkNameInitial = linkName.split('/')[1]
  const url = useStoreUrl()
  const pathInitial = url.pathInitial

  if(linkNameInitial === pathInitial) {
    return "bg-purple-500 block cursor-pointer px-2 py-3 rounded text-white hover:text-gray-300 transition-colors text-sm md:mr-6 md:rounded-none"
  } else {
    return "bg-black block cursor-pointer px-2 py-3 rounded text-white hover:text-gray-300 transition-colors text-sm md:mr-6 md:rounded-none"
  }
})
</script>

<template>
  <li><RouterLink :to="linkName" target="_self" :class="isActiveClass"> {{ name }}</RouterLink></li>
</template>