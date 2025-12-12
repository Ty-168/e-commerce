<script setup lang="ts">
import { computed, ref } from 'vue'
import Rating from './ui/Rating.vue';
import type { Product } from '@/types/Product';

const API_BASE_URL = import.meta.env.VITE_API_URL || '';

const isAdded = ref(false)
const quantity = ref(1)

const props = defineProps<Product>();

const discount = computed(() => {
    // Check for division by zero
    if (!props.price || props.price <= 0) return '0.00';
    const rawPercentage = props.price * (1 - (props.promotionAsPercentage / 100));
    return rawPercentage.toFixed(2);
});

const productImage = computed(() => {
    if (!props.image) return '';
    const pathImage = JSON.parse(props.image);
    if (Array.isArray(pathImage) && pathImage.length > 0) {
        let firstImage = pathImage[0];

        firstImage = firstImage.replace(/\\/g, '/');

        return `${API_BASE_URL}${firstImage}`;
    }
})

const handleAddClick = () => {
  // 1. Change the state to show the input
  isAdded.value = true
  // 2. Perform your actual logic to add the item to the cart
  console.log('Item added to cart!')
}

const updateQuantity = (newQuantity: number) => {
  // Update the quantity and potentially sync with your cart state
  quantity.value = newQuantity
  console.log('New Quantity:', newQuantity)
}

</script>

<template>

    <router-link
        :to="{name: 'product', params: {productId: props.id}}"
        class="relative w-full h-auto max-w-3xs bg-white p-4 border-[#E5E5E5] border-1 rounded-lg shadow-xs hover:shadow-xl transition">
        <div v-if="props.countSold > 10" class="absolute w-14 h-8 bg-[#FD6E6E] left-0 top-5 rounded-r-4xl">
            <div class="w-full h-full flex items-center justify-center text-white text-sm font-semibold">
                Hot
            </div>
        </div>
        <div v-if="props.countSold < 10 && props.promotionAsPercentage > 0" class="absolute w-14 h-8 bg-[#3BB77E] left-0 top-5 rounded-r-4xl">
            <div class="w-full h-full flex items-center justify-center text-white text-sm font-semibold">
                -{{ props.promotionAsPercentage }}%
            </div>
        </div>
        <div class="w-full h-48 flex items-center justify-center">
            <img class="rounded-base mb-4 object-contain w-48 h-48 mx-auto" :src="productImage" alt="product image" />
        </div>
        <div>
            <span class="text-sm">Hodo Foods</span>
            <div class="min-h-16">
                <h5 class="text-base text-heading font-semibold tracking-tight leading-snug mb-1 line-clamp-2">{{ props.name }}</h5>
            </div>
            <Rating :rating="props.rating" />
            <span class="text-sm text-gray-400">{{ props.size }}</span>

            <div class="flex items-center justify-between mt-4">
                <div class="flex flex-row items-center gap-2">
                    <span class="text-xl font-bold text-[#3BB77E]">${{ discount }}</span>
                    <span v-if="props.promotionAsPercentage > 0" class="text-sm line-through font-medium text-[#7E7E7E]">${{ props.price }}</span>
                </div>

                <button v-if="!isAdded" @click="handleAddClick" type="button" class="inline-flex items-center gap-1 font-bold text-[#3BB77E] bg-[#DEF9EC] hover:bg-[#DEF9EC]/75 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs leading-5 rounded-md text-sm px-2 py-1 focus:outline-none">
                    Add 
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" id="plus"><path fill="#3BB77E" d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"></path></svg>
                </button>
                <input  v-else type="number" class="w-16 h-8 rounded-2 rounded text-[#3BB77E] font-bold border-2 " :value="quantity"/>
            </div>
        </div>
    </router-link>


</template>