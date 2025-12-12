<script setup lang="ts">
import ProductDetail from '@/components/product/ProductDetail.vue';
import ProductImage from '@/components/product/ProductImage.vue';

</script>

<template>

<div class="flex flex-col gap-5 items-center justify-center mx-auto max-w-screen-xl mt-5">
    <div class="w-full h-[500px] flex flex-row gap-10">
        <ProductImage/>
        <ProductDetail/>
    </div>
</div>

</template>