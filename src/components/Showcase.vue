<script setup lang="ts">
import ShowcaseImage from '@/assets/images/fresh-apple-shopping.png'
import { IconSend } from '@tabler/icons-vue';


</script>

<template>

<div class="relative w-full h-screen max-h-[500px] bg-cover bg-[url('../assets/images/pattern.jpg')] bg-secondary/20 bg-blend-darken object-fit-contain rounded-lg flex items-center mt-5">
    <div class="w-full h-1/2 flex flex-col justify-between px-10 mx-10">
        <div class="flex flex-col gap-5 w-1/2">
            <p class="font-bold text-6xl">Don’t miss amazing grocery deals</p>
            <span class="font-light text-2xl text-gray-400">Sign up for the daily newsletter</span>

        </div>
        <form class="max-w-md">   
            <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <IconSend class="w-4 h-4 text-body"/>
                </div>
                <input type="search" id="search" class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Your email address" required />
                <button type="button" class="absolute end-1.5 bottom-1.5 text-white bg-primary hover:bg-primary box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Subscribe</button>
            </div>
        </form>
    </div>
    <img :src="ShowcaseImage" alt="showcase" width="800px" height="500px" class="absolute object-fit-fill right-0 top-0"/>
</div>


</template>