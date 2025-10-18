<script setup lang="ts">
import Category from './components/Category.vue';
import Pic1 from './assets/images/burger.png';
import Pic2 from './assets/images/persimmon.png';
import Pic3 from './assets/images/kiwi.png';
import Pic4 from './assets/images/cat-9 1.png';
import Pic5 from './assets/images/cat-3 1.png';
import Pic6 from './assets/images/cat-4 1.png';
import Pic7 from './assets/images/cat-1 4.png';
import Pic8 from './assets/images/cat-15 1.png';
import Pic9 from './assets/images/cat-14 1.png';
import Pic10 from './assets/images/cat-7 1.png';
import Promotion from './components/Promotion.vue';
import Promote1 from './assets/images/Cms-04 1.png';
import Promote2 from './assets/images/Cat-01 1.png';
import Promote3 from './assets/images/Cms-03 1.png';

const Categories = [
  { item: Pic1, message: "Cake & Milk", amount: 14, color: "#F2FCE4" }, 
  { item: Pic2, message: "Peach", amount: 17, color: "#FFFCEB" },
  { item: Pic3, message: "Organic Kiwi", amount: 21, color: "#ECFFEC" },
  { item: Pic4, message: "Red Apple", amount: 68, color: "#FEEFEA" },
  { item: Pic5, message: "Snack", amount: 34, color: "#FFF3EB" },
  { item: Pic6, message: "Black Plum", amount: 25, color: "#FFF3FF" },
  { item: Pic7, message: "Vegetable", amount: 65, color: "#F2FCE4" },
  { item: Pic8, message: "Headphone", amount: 33, color: "#FFFCEB" },
  { item: Pic9, message: "Cake & Milk", amount: 54, color: "#F2FCE4" },
  { item: Pic10, message: "Orange", amount: 63, color: "#FFF3FF" },
]

const Promotions = [
  {text: "Everyday Fresh & Clean with Our Products", color: "#F0E8D5", pic: Promote1, btnColor: "#3BB77E"},
  {text: "Make your Breakfast Healthy and Easy", color: "#F3E8E8", pic: Promote2, btnColor: "#3BB77E"},
  {text: "The best Organic Products Online", color: "#E7EAF3", pic: Promote3, btnColor: "#FDC040"},
]
</script>

<template>
  <div class="flex flex-col gap-5 items-center justify-center">
    <div class="flex flex-row flex-wrap justify-start gap-6">
        
        <Category 
          v-for="(cat, index) in Categories" 
          :key="index" 
          :picture="cat.item" 
          :message="cat.message" 
          :amount="cat.amount" 
          :color="cat.color"
        />
        
    </div>
    
    <div class="flex flex-row flex-wrap justify-start gap-4">
      <Promotion
        v-for="(promo, index) in Promotions"
        :key="index"
        :text="promo.text"
        :color="promo.color"
        :pic="promo.pic"
        :btncolor="promo.btnColor"
      />
    </div>

  </div>
</template>

<style scoped>

</style>
