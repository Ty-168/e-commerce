import { createRouter, createWebHistory, type Router, type RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
    {
        path: "/",
        name: "home",
        component: () => import('../views/HomeView.vue'),
    },
    {
      path: '/categories/:id',
      name: 'category',
      component: () => import('../views/CategoryView.vue'),
    },
    {
      path: '/products',
      name: 'product',
      component: () => import('../views/ProductView.vue'),
    }
]

const router: Router = createRouter({
  history: createWebHistory(),
  routes: routes,
})

export default router;