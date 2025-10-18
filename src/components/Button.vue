<script setup lang="ts">
const props = defineProps<{
    btncolor: string;
}>();
</script>


<template>

    <button class="text-white py-1 px-3 font-semibold rounded-sm" :style="{backgroundColor: props.btncolor}">Shop Now →</button>
</template>