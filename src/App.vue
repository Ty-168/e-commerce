<script setup lang="ts">
import CategoryCard from './components/CategoryCard.vue';
import PromotionCard from './components/PromotionCard.vue';
import { computed, onMounted } from 'vue';
import { ref } from 'vue';
import type { Ref } from 'vue';
import { useProductStore, type Category, type Product, type Promotion } from './stores/productStore';
import Menu from './components/Menu.vue';
import ProductCard from './components/ProductCard.vue';


const API_BASE_URL = import.meta.env.VITE_API_URL || '';




const productStore = useProductStore();

const selectedCategoryGroup = ref('All');

const selectedProductGroup = ref('All');
const selectedProductCategory = ref('');

const categoryChangeGroup = (groupName: string) => {
  selectedCategoryGroup.value = groupName;
}

const productChangeGroup = (groupName: string) => {
  selectedProductGroup.value = groupName;
}

const productChangeCategory = (category: string) => {
  selectedProductCategory.value = category;
}

const categories: Ref<Category[] | null> = computed(() => {
  if(selectedCategoryGroup.value === 'All'){
    return productStore.getCategories;
  }else{
    return productStore.getCategoriesByGroup(selectedCategoryGroup.value);
  }
});

const promotions: Ref<Promotion[] | null> = computed(() => {
  return productStore.getPromotions;
});

const products : Ref<Product[] | null> = computed(() => {
  let listToFilter = productStore.getProducts;
  if(selectedProductGroup.value !== 'All'){
    listToFilter = productStore.getProductsByGroup(selectedProductGroup.value);
  }

  return listToFilter;
});



onMounted(() => {
  productStore.fetchAllData();
})

const menu = computed(() => {
  // 'productStore.getGroups' is already reactive!
  return productStore.getGroups;
});


</script>

<template>

  <div class="flex flex-col gap-5 items-center justify-center px-3">
    <div class="flex flex-col w-full max-w-8xl justify-start gap-4">
      <Menu 
        :menus="menu" 
        :section="'Featured Categories'"
        :selectedGroup="selectedCategoryGroup"
        @group-selected="categoryChangeGroup"
      /> 
      <TransitionGroup name="fade" tag="div" class="flex flex-row flex-wrap gap-6 justify-center items-center">
        <CategoryCard 
          v-for="(cat, index) in categories" 
          :key="index"
          :id="cat.id" 
          :picture="cat.image" 
          :message="cat.name" 
          :amount="cat.productCount" 
          :color="cat.color"
          :selectedCategory="selectedProductCategory"
          @category-selected="productChangeCategory"

          :isSelected="cat.id === selectedProductCategory"
        />
      </TransitionGroup>
      <div class="flex flex-row flex-wrap gap-3 justify-between items-center">
        <PromotionCard
          v-for="(promo, index) in promotions"
          :key="index"
          :text="promo.title"
          :color="promo.color"
          :pic="promo.image"
          :btncolor="promo.buttonColor"
        />
      </div>
    </div>
    <div class="flex flex-col w-full max-w-8xl justify-center gap-4">
      <Menu 
        :menus="menu" 
        :section="'Popular Products'"
        :selectedGroup="selectedProductGroup"
        @group-selected="productChangeGroup"  
      /> 
      <TransitionGroup name="fade" tag="div" class="flex flex-row flex-wrap gap-6 justify-center items-center">
        <ProductCard 
          v-for="(product, index) in products" 
          :key="index"
          :name="product.name"
          :rating="product.rating"
          :size="product.size"
          :image="product.image"
          :price="product.price"
          :promotion="product.promotionAsPercentage"
          :count-sold="product.countSold"
          :instock="product.instock"
          />
      </TransitionGroup>
    </div>

  </div>
</template>

<style scoped>
/* FADE IN/OUT TRANSITION */

.fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
  position: absolute; /* Ensures the element leaves without jumping the layout */
}

/* Styles for the element that is entering the list (fades in) */
.fade-enter-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
  transition-delay: 0.2s; /* Slight delay to make the fade in happen after elements start moving */
}

/* Initial state for entering and final state for leaving (opacity 0) */
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scale(0.9); /* Add a slight zoom effect */
}

/* Moving animation */
.fade-move {
  transition: transform 0.5s ease;
}
</style>
