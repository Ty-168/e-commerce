<script setup lang="ts">
import { ref, computed } from 'vue';
// Assuming these Tabler icons are available in your project structure
import { IconChevronLeft, IconChevronRight } from '@tabler/icons-vue'; 
const API_BASE_URL = import.meta.env.VITE_API_URL || '';
// Define the images prop
const props = defineProps<{
    images: string[]; // Array of image URLs/paths
}>();

// Number of images to show at once
const ITEMS_PER_VIEW = 4;
// Current index offset (how many single item slots we have slid past)
const currentOffset = ref(0);
// The maximum number of steps we can slide (Total Images - Items Shown)
const maxOffset = computed(() => Math.max(0, props.images.length - ITEMS_PER_VIEW));

// Calculate the CSS transform value
// Moves one full item width (25% of the 4-item track) for each step
const transformStyle = computed(() => {
    // 100% / ITEMS_PER_VIEW (4) = 25%. We slide 25% for each offset step.
    const slidePercentage = (100 / ITEMS_PER_VIEW) * currentOffset.value;
    return `translateX(-${slidePercentage}%)`;
});

const nextSlide = () => {
    if (currentOffset.value < maxOffset.value) {
        currentOffset.value++;
    } else {

    }
};

const prevSlide = () => {
    if (currentOffset.value > 0) {
        currentOffset.value--;
    } else {

    }
};

const isPrevDisabled = computed(() => currentOffset.value === 0);
const isNextDisabled = computed(() => currentOffset.value === maxOffset.value);

</script>

<template>
    <div class="relative w-full">
        <div class="overflow-hidden relative rounded-lg">
            
            <div 
                class="flex transition-transform duration-500 ease-in-out"
                :style="{ 
                    transform: transformStyle,
                    // Track width must equal (Total Images / Images Shown) * 100%
                    width: `${props.images.length / ITEMS_PER_VIEW * 100}%` 
                }"
            >
                <div 
                    v-for="(image, index) in props.images" 
                    :key="index"
                    class="p-2 shrink-0"
                    :style="{ width: `${100 / props.images.length}%` }"
                >
                    <img 
                        :src="`${API_BASE_URL}${image}`"
                        :alt="'Product Image ' + (index + 1)"
                        class="w-full h-full object-cover aspect-square rounded-base"
                    />
                </div>
            </div>
        </div>

        <button 
            @click="prevSlide" 
            :disabled="isPrevDisabled"
            type="button" 
            class="absolute top-1/2 start-0 z-10 -translate-y-1/2 p-2 text-gray-800 rounded-full bg-primary/70 hover:bg-primary hover:text-white disabled:opacity-50 disabled:cursor-not-allowed transition "
        >
            <IconChevronLeft class="w-6 h-6 " />
        </button>

        <button 
            @click="nextSlide" 
            :disabled="isNextDisabled"
            type="button" 
            class="absolute top-1/2 end-0 z-10 -translate-y-1/2 p-2 text-gray-800 rounded-full bg-primary/70 hover:bg-primary hover:text-white disabled:opacity-50 disabled:cursor-not-allowed transition "
        >
            <IconChevronRight class="w-6 h-6" />
        </button>
    </div>
</template>