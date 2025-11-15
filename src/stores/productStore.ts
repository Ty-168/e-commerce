import axios from "axios";
import { defineStore } from "pinia";

const API_BASE_URL = import.meta.env.VITE_API_URL || '';

export interface Category {
  image: string;
  name: string;
  productCount: string;
  color: string;
  group: string;
}

export interface Promotion {
  title: string;
  color: string;
  image: string;
  buttonColor: string;
}

export interface Product {
  name: string;
  rating: number;
  size: string;
  image: string;
  price: number;
  promotionAsPercentage: number;
  categoryId: number;
  instock: number;
  countSold: number;
  group: string;
}

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
       getCategoriesByGroup: (state) => {
           return (groupName: string) => state.categories.find((category) => category.group === groupName)
       },
       // more getters here
  },
  actions: {
       async fetchGroups(){
        try{
            const groupData = await axios.get(`${API_BASE_URL}api/groups`);
            this.groups = groupData.data
        } catch(err) {
            console.log(err);
        }
       }, 

        async fetchCategories(){
            try{
                const catData = await axios.get(`${API_BASE_URL}api/categories`);
                this.categories = catData.data;
            } catch(err) {
                console.log(err);
            }
        }
  },
}) 