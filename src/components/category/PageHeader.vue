<script setup lang="ts">
import { computed, type Ref } from 'vue';
import { useRoute, type RouteLocationRaw } from 'vue-router';
import BreadCrumb from '../ui/BreadCrumb.vue';

interface BreadcrumbLink {
    to?: RouteLocationRaw; // Can be a route object { name: '...' } or undefined
    label: string;
}

const props = defineProps<{
    name: string | undefined
}>();

const route = useRoute();
const breadcrumbSegments = computed(() => {
    const segments: BreadcrumbLink[] = [
        // Linkable segment (has 'to')
        { to: { name: 'home' }, label: 'Home' }
    ];
    segments.push({
        label: 'Categories' 
    });
    if (props.name) {
        segments.push({ 
            // 2. Final segment (missing 'to', which is now allowed)
            label: props.name,
        });
    }

    return segments;
});
</script>


<template>

<div class="w-full h-screen max-h-[230px] bg-accent/80 bg-[url('../assets/images/pattern2.png')]  bg-bottom bg-blend-normal object-fill flex items-center rounded-lg">

    <div class="w-full h-1/2 flex flex-col gap-3 px-10 mx-10 justify-center">
        <p class="font-bold text-4xl text-black">{{ props.name }}</p>
        
        <BreadCrumb :segments="breadcrumbSegments" />
    </div>
</div>

</template>