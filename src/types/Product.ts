export interface Product {
  id: string;
  name: string;
  rating: string;
  size: string;
  image: string;
  price: number;
  promotionAsPercentage: number;
  categoryId: string;
  instock: number;
  countSold: number;
  group: string;
}

export interface Category {
  image: string;
  name: string;
  productCount: string;
  color: string;
  group: string;
  id: string;
}

export interface Promotion {
  title: string;
  color: string;
  image: string;
  buttonColor: string;
}