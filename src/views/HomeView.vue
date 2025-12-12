<script setup lang="ts">
import CategoryCard from '../components/CategoryCard.vue';
import PromotionCard from '../components/PromotionCard.vue';
import { computed, onMounted } from 'vue';
import { ref } from 'vue';
import type { Ref } from 'vue';
import { useProductStore } from '../stores/productStore';
import Menu from '../components/Menu.vue';
import ProductCard from '../components/ProductCard.vue';
import Navbar from '@/components/Navbar.vue';
import Showcase from '@/components/Showcase.vue';
import type { Category, Product, Promotion } from '@/types/Product';



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

  <div class="flex flex-col gap-5 items-center justify-center mx-auto max-w-screen-xl">
    <Showcase/>
    <div class="flex flex-col w-full max-w-8xl justify-start gap-4">
      <Menu 
        :menus="menu" 
        :section="'Featured Categories'"
        :selectedGroup="selectedCategoryGroup"
        @group-selected="categoryChangeGroup"
      /> 
      <TransitionGroup name="fade" tag="div" class="flex flex-row flex-wrap gap-4 justify-center items-center">
        <CategoryCard 
          v-for="(cat, index) in categories" 
          :key="index"
          :id="cat.id" 
          :picture="cat.image" 
          :name="cat.name" 
          :amount="cat.productCount" 
          :color="cat.color"
          :group="cat.group"
          :selectedCategory="selectedProductCategory"
          @category-selected="productChangeCategory"

          :isSelected="cat.id === selectedProductCategory"
        />
      </TransitionGroup>
      <div class="flex flex-row flex-wrap gap-4 justify-center items-center">
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

  </div>
</template>

