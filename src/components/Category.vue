<script setup lang="ts">
import { computed } from 'vue';

const API_BASE_URL = import.meta.env.VITE_API_URL || '';

// ... script remains the same
const props = defineProps<{
  picture: string;
  message: string;
  color: string;
  amount: string;
}>();

const getImages = computed(() => {
  if (!props.picture) return '';
  return `${API_BASE_URL}${props.picture}`
});

console.log(getImages);
</script>

<template>
<div :style="{backgroundColor: color}" class="flex flex-col items-center justify-center w-32 h-40 rounded-md p-4">
    <img :src="getImages" alt="pic" class="w-28 h-28 object-contain"/> 
    <h5 class="font-bold text-black text-sm text-center">{{ props.message }}</h5> 
    <span class="text-xs text-[#B6B6B6]">{{ props.amount }} items</span> 
  </div>    

</template>