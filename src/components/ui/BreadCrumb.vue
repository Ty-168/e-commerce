<script setup lang="ts">
import type { PropType } from 'vue';
import { RouterLink, type RouteLocationRaw } from 'vue-router';

interface BreadcrumbLink {
    to?: RouteLocationRaw; 
    label: string;
}

const props = defineProps({
    // 2. Use PropType to explicitly cast the array type
    segments: {
        type: Array as PropType<BreadcrumbLink[]>, // 👈 This is the key fix
        required: true
    }
});

// Helper to check if a segment is the last one (the active, non-clickable one)
const isLast = (index: number) => {
    return index === props.segments.length - 1;
};
</script>

<template>
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        
        <template v-for="(segment, index) in props.segments" :key="index">
            <li v-if="!segment.to" :aria-current="isLast(index) ? 'page' : undefined">
                <div class="flex items-center space-x-1.5">
                    <svg v-if="index > 0" class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                    
                    <span :class="{'text-body-subtle': isLast(index), 'text-body': !isLast(index)}" 
                          class="inline-flex items-center text-sm font-medium">
                        {{ segment.label }}
                    </span>
                </div>
            </li>
            
            <li v-else class="inline-flex items-center">
                <div v-if="index > 0" class="flex items-center space-x-1.5">
                    <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                </div>
                
                <router-link :to="segment.to" class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
                    <svg v-if="index === 0" class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/></svg>
                    {{ segment.label }}
                </router-link>
            </li>
        </template>
    </ol>
</nav>
</template>