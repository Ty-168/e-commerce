<script setup lang="ts">
import { computed } from 'vue';

const API_BASE_URL = import.meta.env.VITE_API_URL || '';

const emit = defineEmits(['category-selected']);

// ... script remains the same
const props = defineProps<{
  picture: string;
  message: string;
  color: string;
  amount: string;
  selectedCategory: string;
  id: string;
  isSelected: boolean;
}>();
console.log(props.isSelected);
const getImages = computed(() => {
  if (!props.picture) return '';
  return `${API_BASE_URL}${props.picture}`
});

const selectCategory = (categoryId: string) => {
  emit('category-selected', categoryId);
}
</script>

<template>

    <button 
      @click="selectCategory(props.id)" :style="{backgroundColor: color, }" 
      :class="{
            'text-white shadow-lg border-green-500 border-1': props.isSelected,
            'bg-neutral-primary-soft': !props.isSelected // Fallback to default background
        }"
      class="flex flex-col items-center justify-center w-28 h-36 rounded-md p-4 hover:shadow-xl hover:border hover:border-green-500 transition "
      >
      <img :src="getImages" alt="pic" class="w-28 h-28 object-contain"/> 
      <h5 class="font-bold text-black text-sm text-center">{{ props.message }}</h5>
      <span class="text-xs text-[#B6B6B6]">{{ props.amount }} items</span> 
    </button>    


</template>