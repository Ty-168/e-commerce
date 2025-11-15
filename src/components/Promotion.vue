<script setup lang="ts">
import { computed } from 'vue';
import Button from './Button.vue'
// ... script remains the same

const API_BASE_URL = import.meta.env.VITE_API_URL || '';

const props = defineProps<{
  text: string
  color: string
  pic: string
  btncolor: string
}>()

const getImage = computed(() => {
  if(!props.pic) return '';
  return `${API_BASE_URL}${props.pic}`
})
</script>

<template>
  <div
    class="w-[480px] h-64 relative flex flex-col justify-center rounded-md px-4"
    :style="{ backgroundColor: props.color }"
  >
    <div class="flex flex-col items-start z-1 gap-3 w-56 px-4">
      <h1 class="text-black font-bold text-xl">{{ props.text }}</h1>
      <Button :btncolor="props.btncolor" :title="props.text" />
    </div>
    <img :src="getImage" alt="pic" class="absolute bottom-0 right-0 h-46 w-auto object-contain" />
  </div>
</template>
