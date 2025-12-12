<script setup lang="ts">

import { IconArrowsShuffle, IconHeart, IconShoppingCart } from '@tabler/icons-vue';
import Rating from '../ui/Rating.vue';
import type { Product } from '@/types/Product';
import { computed } from 'vue';

const rating = "4";
const props = defineProps<{
    products: Product
}>();

const discount = computed(() => {
    // Check for division by zero
    if (!props.products.price || props.products.price <= 0) return '0.00';
    const rawPercentage = props.products.price * (1 - (props.products.promotionAsPercentage / 100));
    return rawPercentage.toFixed(2);
});

</script>

<template>

<div class="w-full p-5 lg:w-1/2 lg:p-0 flex flex-col gap-4 justify-between">
    <div v-if="props.products.instock > 0" class="w-1/6 bg-success text-success-text mix-w-3xs text-sm py-1 text-center rounded-sm">
        In Stock
    </div>
    <div v-else class="w-1/6 bg-error text-error-text mix-w-3xs text-sm py-1 text-center rounded-sm">
        Out of Stock
    </div>
    <p class="font-bold text-4xl">{{ props.products.name }}</p>
    <Rating :rating="props.products.rating"/>
    <div class="flex flex-row items-end gap-5">
        <span class="text-primary font-bold text-6xl">${{ discount }}</span>
        <span v-if="props.products.promotionAsPercentage > 0" class="line-through text-disable-text text-3xl font-bold">${{ props.products.price }}</span>
    </div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla eum amet voluptates earum officiis deleniti reprehenderit labore! Ipsum suscipit architecto ullam voluptate nihil fugiat, vel quas, illo, accusantium praesentium eaque.</p>
    <div class="w-full flex flex-row gap-3 items-center">
        <input  type="number" class="w-20 h-10 rounded-2 rounded text-[#3BB77E] font-bold border-2 border-primary" value="1"/>
        <button  type="button" class="inline-flex items-center gap-1 font-bold text-white bg-primary hover:bg-primary/75 box-border border border-transparent focus:ring-4 focus:ring-primary/25 shadow-xs leading-5 rounded-md text-sm px-5 py-2 focus:outline-none">
            <IconShoppingCart size="14"/>
            Add to Cart
        </button>
        <div class="border text-gray-400 border-gray-300 p-2 rounded-sm hover:bg-red-500 hover:text-white">
            <IconHeart size="20"/>
        </div>
        <div class="border text-gray-400 border-gray-300 p-2 rounded-sm hover:bg-blue-500 hover:text-white">
            <IconArrowsShuffle size="20"/>
        </div>
    </div>

    <div class="w-full flex flex-col gap-2">
        <p>Vendor: <span class="text-gray-400">NestMart</span></p>
        <p>SKU: <span class="text-gray-400">FWM15VKT</span></p>
    </div>
</div>    
</template>