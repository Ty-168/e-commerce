<script setup lang="ts">
// ... script remains the same
const props = defineProps<{
  picture: string;
  message: string;
  color: string;
  amount: number;
}>();
</script>

<template>
<div :style="{backgroundColor: color}" class="flex flex-col items-center justify-center w-32 h-40 rounded-md p-2">
    <img :src="props.picture" alt="pic" class="w-16 h-16 object-contain"/> 
    <h5 class="font-bold text-black text-sm text-center">{{ props.message }}</h5> 
    <span class="text-xs text-[#B6B6B6]">{{ props.amount }} items</span> 
  </div>    

</template>