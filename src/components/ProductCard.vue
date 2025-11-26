<script setup lang="ts">
import { computed } from 'vue'

const API_BASE_URL = import.meta.env.VITE_API_URL || '';


interface Product{
    name: string
    rating: string
    size: string
    image: string
    price: number
    promotion: number
    instock: number
    countSold: number
}

const props = defineProps<Product>();

const discount = computed(() => {
    // Check for division by zero
    if (!props.price || props.price <= 0) return '0.00';
    const rawPercentage = props.price * (1 - (props.promotion / 100));
    return rawPercentage.toFixed(2);
});

// Star Rating
const maxStars = 5;

const ratingValue = computed(() => {
    // Ensure the rating is treated as a number, defaulting to 0
    return parseFloat(props.rating) || 0;
});

const filledCount = computed(() => {
    // The number of stars to fill completely (e.g., 4.5 becomes 4)
    return Math.floor(ratingValue.value);
});

const emptyCount = computed(() => {
    // The remaining number of stars that should be empty (or half)
    // Example: 5 - (filledCount: 4) = 1
    return maxStars - filledCount.value;
});

const producImage = computed(() => {
    if (!props.image) return '';
    const pathImage = JSON.parse(props.image);
    return `${API_BASE_URL}${pathImage}`
})
console.log(producImage);
</script>

<template>

    <div class="relative w-full h-auto max-w-3xs bg-white p-4 border-[#E5E5E5] border-1 rounded-lg shadow-xs hover:shadow-xl transition">
        <div v-if="props.countSold > 10" class="absolute w-14 h-8 bg-[#FD6E6E] left-0 top-5 rounded-r-4xl">
            <div class="w-full h-full flex items-center justify-center text-white text-sm font-semibold">
                Hot
            </div>
        </div>
        <div v-if="props.countSold < 10 && props.promotion > 0" class="absolute w-14 h-8 bg-[#3BB77E] left-0 top-5 rounded-r-4xl">
            <div class="w-full h-full flex items-center justify-center text-white text-sm font-semibold">
                -{{ props.promotion }}%
            </div>
        </div>
        <a href="#" class="w-full h-48 flex items-center justify-center">
            <img class="rounded-base mb-4 object-contain w-48 h-48 mx-auto" :src="producImage" alt="product image" />
        </a>
        <div>
            <span class="text-sm">Hodo Foods</span>
            <div class="min-h-16">
                <a href="#">
                    <h5 class="text-base text-heading font-semibold tracking-tight leading-snug mb-1 line-clamp-2">{{ props.name }}</h5>
                </a>

            </div>
            <div class="flex items-center space-x-0 rtl:space-x-reverse">

                <svg 
                    v-for="i in filledCount" 
                    :key="'full-' + i" 
                    class="w-4 h-4 text-yellow-500" 
                    aria-hidden="true" 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="24" 
                    height="24" 
                    fill="currentColor" 
                    viewBox="0 0 24 24">
                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                </svg>

                <svg 
                    v-if="ratingValue % 1 !== 0" 
                    class="w-4 h-4 text-yellow-500 opacity-50" 
                    aria-hidden="true" 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="24" 
                    height="24" 
                    fill="currentColor" 
                    viewBox="0 0 24 24">
                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552-.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                </svg>


                <svg 
                    v-for="i in emptyCount - (ratingValue % 1 !== 0 ? 1 : 0)" 
                    :key="'empty-' + i" 
                    class="w-4 h-4 text-gray-300" 
                    aria-hidden="true" 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="24" 
                    height="24" 
                    fill="currentColor" 
                    viewBox="0 0 24 24">
                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                </svg>
                <span class="text-sm font-medium text-gray-400">({{ props.rating }})</span>

            </div>
            <span class="text-sm text-gray-400">{{ props.size }}</span>

            <div class="flex items-center justify-between mt-4">
                <div class="flex flex-row items-center gap-2">
                    <span class="text-xl font-bold text-[#3BB77E]">${{ discount }}</span>
                    <span v-if="props.promotion > 0" class="text-sm line-through font-medium text-[#7E7E7E]">${{ props.price }}</span>
                </div>
                <button type="button" class="inline-flex items-center gap-1 font-bold text-[#3BB77E] bg-[#DEF9EC] hover:bg-[#DEF9EC]/75 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs leading-5 rounded-md text-sm px-2 py-1 focus:outline-none">
                    Add 
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" id="plus"><path fill="#3BB77E" d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"></path></svg>
                </button>
            </div>
        </div>
    </div>


</template>