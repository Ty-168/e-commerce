<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    // Expects the rating string (e.g., "4.5")
    rating: string 
}>();

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
    // We subtract the half-star slot if it exists
    return maxStars - filledCount.value - (ratingValue.value % 1 !== 0 ? 1 : 0);
});

// Check for a half star (any decimal value)
const hasHalfStar = computed(() => {
    return ratingValue.value % 1 !== 0;
});

const labelStar = computed(() => {
    return parseFloat(props.rating).toFixed(1);
})
</script>

<template>
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
        v-if="hasHalfStar" 
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
        v-for="i in emptyCount" 
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

    <span class="text-sm font-medium text-gray-400">({{ labelStar }})</span>
</div>
</template>