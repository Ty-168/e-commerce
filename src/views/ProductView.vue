<script setup lang="ts">
import ProductDescription from '@/components/product/ProductDescription.vue';
import ProductDetail from '@/components/product/ProductDetail.vue';
import ProductImage from '@/components/product/ProductImage.vue';
import { useProductStore } from '@/stores/productStore';
import type { Product } from '@/types/Product';
import { IconPackage } from '@tabler/icons-vue';
import { computed, type Ref } from 'vue';
import { useRoute } from 'vue-router';


const route = useRoute();
const productStore = useProductStore();
const products : Ref<Product | undefined> = computed(() => {
    const id = route.params.productId as string;
    if (!id) return undefined;
    return productStore.getProductById(id);
});

console.log(products.value);

</script>

<template>

<div v-if="products" class="flex flex-col gap-5 items-center justify-center mx-auto max-w-screen-xl mt-5">
    <div class="w-full h-full flex flex-col lg:flex-row gap-10">
        <ProductImage :image="products.image"/>
        <ProductDetail :products="products"/>
    </div>

    <div class="w-full border border-gray-200 p-10 mt-10 rounded-lg">
        <ProductDescription/>
    </div>
</div>

<div v-else class="h-full max-h-1/2 flex items-center justify-center ">
    <div class="w-full flex flex-col items-center gap-2 text-center bg-gray-100 rounded-base text-primary shadow-inner p-10">
      <IconPackage class="w-12 h-12" />
      <span class="text-lg font-medium text-gray-500">Product Missing</span>
    </div>
</div>

</template>