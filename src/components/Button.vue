<script setup lang="ts">
const props = defineProps<{
  btncolor: string
  title: string
}>()

const shopNow = () => {
  alert("Let's shop: " + props.title)
}
</script>

<template>
  <button
    class="text-white py-1 px-3 font-semibold rounded-sm"
    :style="{ backgroundColor: props.btncolor }"
    v-on:click="shopNow()"
  >
    Shop Now →
  </button>
</template>
