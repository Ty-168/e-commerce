import type { Category, Product, Promotion } from "@/types/Product";
import axios from "axios";
import { defineStore } from "pinia";

const API_BASE_URL = import.meta.env.VITE_API_URL || '';

export interface Products {
    categories: Category[];
    promotions: Promotion[];
    groups: string[];
    products: Product[];
}

export const useProductStore = defineStore('product', {
  state: (): Products => ({
       groups: [],
       promotions: [],
       categories: [],
       products: []
  }),
  getters: {
        getGroups: (state) => {
            return state.groups;
        },
        getCategories: (state) => {
          return state.categories;
        },
        getPromotions: (state) => {
          return state.promotions;
        },
        getProducts: (state) => {
          return state.products;
        },

        getCategoriesByGroup: (state) => {
          return (groupName: string) => state.categories.filter((category) => category.group === groupName)
        },

        getProductsByCategory: (state) => {
          return (categoryId: string) => state.products.filter((product) => String(product.categoryId) === String(categoryId))
        },
        getProductsByGroup: (state) => {
          return (groupName: string) => state.products.filter((product) => product.group === groupName);
        },
        
        // Get By ID
        getCategoriesById: (state) => {
          return (categoryId: string) => state.categories.find((category) => String(category.id) === String(categoryId))
        },
        getProductById: (state) => {
          return (productId: string) => state.products.find((product) => String(product.id) === String(productId))
        },
       // more getters here
  },
  actions: {
    
      async fetchAllData(){
        try{
          const productPromise = axios.get(`${API_BASE_URL}api/products`);
          const categoryPromise = axios.get(`${API_BASE_URL}api/categories`);
          const promotionPromise = axios.get(`${API_BASE_URL}api/promotions`);
          const groupPromise = axios.get(`${API_BASE_URL}api/groups`);

          const [proRes, catRes, promoRes, groupRes] = await Promise.all(
            [productPromise, categoryPromise, promotionPromise, groupPromise]
          );

          this.products = proRes.data;
          this.categories = catRes.data;
          this.promotions = promoRes.data;
          this.groups = groupRes.data;
        } catch(err) {
          console.log(err);
        }
      },
      
       async fetchGroups(){
        try{
            const groupData = await axios.get(`${API_BASE_URL}api/groups`);
            this.groups = groupData.data
        } catch(err) {
            console.log(err);
        }
       }, 
        // async fetchCategories(){
        //     try{
        //         const catData = await axios.get(`${API_BASE_URL}api/categories`);
        //         this.categories = catData.data;
        //     } catch(err) {
        //         console.log(err);
        //     }
        // }
  },
}) 