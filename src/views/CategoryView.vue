<script setup lang="ts">
import PageHeader from '@/components/category/PageHeader.vue';
import ProductCard from '@/components/ProductCard.vue';
import { useProductStore } from '@/stores/productStore';
import type { Category, Product } from '@/types/Product';
import { computed, onMounted, watch, type Ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const productStore = useProductStore();
const categoryId: string = route.params.id as string;

console.log(categoryId);
const categoryName = computed(() => {
    const id = route.params.id as string;
    return productStore.getCategoriesById(id)?.name;
})

console.log(categoryName.value);
const products : Ref<Product[] | null> = computed(() => {
    const id = route.params.id as string;
    if (!id) return null;
    return productStore.getProductsByCategory(id);
})
console.log(products.value);
watch(categoryName, (newVal) => {
    console.log("Category Updated:", newVal);
});

onMounted(() => {
})

</script>

<template>
    <div class="flex flex-col gap-5 items-center justify-center mx-auto max-w-screen-xl mt-5">
        <PageHeader 
            :name="categoryName"
        />
        <TransitionGroup name="fade" tag="div" class="flex flex-row flex-wrap gap-6 justify-center items-center">
        <ProductCard 
          v-for="(product, index) in products" 
          :key="index"
          :id="product.id"
          :name="product.name"
          :rating="product.rating"
          :size="product.size"
          :image="product.image"
          :price="product.price"
          :promotion-as-percentage="product.promotionAsPercentage"
          :count-sold="product.countSold"
          :instock="product.instock"
          :group="product.group"
          :category-id="product.categoryId"
          />
        </TransitionGroup>
    </div>

</template>