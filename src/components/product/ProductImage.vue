<script setup lang="ts">
import { IconSearch } from '@tabler/icons-vue';
import { initFlowbite } from 'flowbite';
import { onMounted } from 'vue';
onMounted(() => {
    initFlowbite();
})
</script>

<template>
<div class="w-1/2">
    <div class="relative h-full grid gap-4 items-center border border-gray-500 rounded-lg mb-5">
        <IconSearch class="absolute right-5 top-5 text-gray-400"/>
        <div>
            <img 
                src="@/assets/images/mango.jpg" 
                alt="productImage" 
                class="w-2/3 h-auto mx-auto object-contain block"
            />
        </div>
    </div>
<div id="gallery" class="relative w-full h-1/2" data-carousel="static">
    
    <div class="relative overflow-hidden rounded-lg p-4 h-1/2">

        <div class="duration-700 ease-in-out hidden" data-carousel-item="active">
            <div class="grid grid-cols-4 gap-4">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="Product Image 1">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="Product Image 2">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="Product Image 3">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="Product Image 4">
            </div>
        </div>

        <div class="duration-700 ease-in-out hidden" data-carousel-item>
            <div class="grid grid-cols-4 gap-4">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg" alt="Product Image 5">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-6.jpg" alt="Product Image 6">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-7.jpg" alt="Product Image 7">
                <img class="w-full h-auto object-cover aspect-square rounded-base" 
                     src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-8.jpg" alt="Product Image 8">
            </div>
        </div>
        
    </div>
    
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
</div>

</template>