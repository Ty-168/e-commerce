<script setup lang="ts">
import { IconSearch } from '@tabler/icons-vue';
import ImageSlider from '../ui/ImageSlider.vue';
import type{ Product } from '@/types/Product';
import { computed } from 'vue';

const API_BASE_URL = import.meta.env.VITE_API_URL || '';

const props = defineProps<{
    image: string
}>();

const parseJsonImage = computed(() => {
    if (!props.image) return [];
    
    try {
        const imageArray = JSON.parse(props.image);
        if (Array.isArray(imageArray)) {
            // Clean up backslashes in the paths for all images
            return imageArray.map(path => path.replace(/\\/g, '/'));
        }
    } catch (e) {
        console.error("Error parsing product image JSON:", e);
    }
    return [];
});

console.log(parseJsonImage);

const productFirstImage = computed(() => {
    if (parseJsonImage.value.length === 0) {
        return '';
    }
    const firstImage = parseJsonImage.value[0];
    return `${API_BASE_URL}${firstImage}`;
});

console.log(productFirstImage)
const productImages = computed(() => {
    // ✅ FIX: Use .slice(1) directly on the array to skip the first element
    const skipFirstImage = parseJsonImage.value.slice(1);
    return skipFirstImage; // Returns ["path2.jpg", "path3.jpg", ...]
});

console.log(productImages);
</script>

<template>
<div class="w-full lg:w-1/2 h-full">
    <div class="relative h-full grid gap-4 items-center border border-gray-300 rounded-lg mb-5">
        <IconSearch class="absolute right-5 top-5 text-gray-400"/>
        <div>
            <img 
                :src="productFirstImage"
                alt="productImage" 
                class="w-[60%] h-auto mx-auto object-contain block"
            />
        </div>
    </div>
    <div v-if="productImages.length <= 0" class="w-full flex justify-center items-center">
        <span class="italic">No Sub Image</span>

    </div>
    <div v-else class="w-full">
        <ImageSlider :images="productImages" />
    </div>
</div>

</template>