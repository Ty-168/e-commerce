<script setup lang="ts">
import { computed, onMounted, type Ref } from 'vue';
import Logo from '../assets/Logo.png';
import Searchbox from './Searchbox.vue';
import { IconFlame, IconHeadset, IconHeart, IconRefresh, IconShoppingCart, IconUser } from '@tabler/icons-vue';
import MenuItem from './MenuItem.vue';
import Dropdown from './ui/Dropdown.vue';
import { useProductStore } from '@/stores/productStore';
import type { Category } from '@/types/Product';

const productStore = useProductStore();


const categories : Ref<Category[] | null> = computed(() => {
    return productStore.getCategories;
})


const menuItems = computed(() => [
    {icon: IconUser, label: "Account"},
    {icon: IconRefresh, label: "Compare"},
    {icon: IconHeart, label: "Wishlist"},
    {icon: IconShoppingCart, label: "Cart"},
])

const subMenuItem = computed(() => [
    {label: "Home", isDropdown: false, dropdownId: undefined},
    {label: "Food", isDropdown: true, dropdownId: "foodDropdown"},
    {label: "Vegetables", isDropdown: true, dropdownId: "vegetablesDropdown"},
    {label: "Drink", isDropdown: false, dropdownId: undefined},
    {label: "Cookies", isDropdown: false, dropdownId: undefined},
    {label: "Meat & Seafood", isDropdown: true, dropdownId: "meatDropdown"},
    {label: "Bakery", isDropdown: false, dropdownId: undefined},
])

const Hotdeal = computed(() => {
    const categoryList = categories.value;
    if (!categoryList || categoryList.length === 0) {
        return undefined;
    }

    // Use .reduce to iterate through the categories and find the one with the highest product count
    const topCategory = categoryList.reduce((max, current) => {
        
        // 1. Extract the number from the string (e.g., "12 items" -> 12)
        const maxCount = parseInt(max.productCount);
        const currentCount = parseInt(current.productCount);

        // 2. Compare the counts and return the category object with the higher count
        if (currentCount > maxCount) {
            return current;
        } else {
            return max;
        }
    });

    return topCategory; // This returns the single Category object with the highest count
});

const hotDealRoute = computed(() => {
    // Check if Hotdeal exists and has an ID property (which it should, based on the Category type)
    if (Hotdeal.value && Hotdeal.value.id) {
        // Use the router name 'category' (as defined in src/router/index.ts)
        return { name: 'category', params: { id: Hotdeal.value.id } };
    }
    // Fallback to the home page if no hot deal is found yet
    return { name: 'home' };
});

onMounted(() => {
    productStore.fetchAllData();
})
</script>

<template>
 
<header class="w-full ">
  <nav class="bg-neutral-primary">
        <div class="w-full flex justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img :src="Logo" class="h-14" alt="Logo" />
            </a>
            <div class="w-2xl">
                <Searchbox/>
            </div>

            <div v-for="item in menuItems" class="flex items-center gap-2 rtl:space-x-reverse">
                <component :is="item.icon" class="w-5 h-5" />
                <span class="text-gray-400 hover:text-gray-600 transition-all">{{ item.label }}</span>
            </div>
        </div>
  </nav>
  <nav class="bg-neutral-secondary-soft border-y border-default">
      <div class="max-w-screen-xl px-4 py-3 mx-auto">
          <div class="flex items-center">
              <ul class="w-full flex flex-row items-center justify-between font-medium mt-0 space-x-4 rtl:space-x-reverse text-sm">
                <li>
                    <Dropdown/>
                </li>
                <li class="flex flex-row gap-2 items-center">
                    <router-link :to="hotDealRoute" class="flex flex-row items-center gap-2">
                        <IconFlame/> Hot Deals
                    </router-link>
                </li>
                <li class="flex flex-row gap-2 items-center">
                    <MenuItem v-for="subitem in subMenuItem"
                        :nav="subitem.label"
                        :is-dropdown="subitem.isDropdown"
                        :dropdown-id="subitem.dropdownId"
                    />  
                </li>
                <li class="flex flex-row gap-2 justify-center items-center">
                    <IconHeadset size="38"/>
                    <div class="flex flex-col">
                        <span class="text-xl text-primary font-bold">012 345 678</span>
                        <span class="text-sm text-gray-400 font-light">24/7 Support Center</span>
                    </div>
                </li>
              </ul>
          </div>
      </div>
  </nav>
</header>

</template>