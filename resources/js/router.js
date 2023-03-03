import { createRouter, createWebHistory } from "vue-router"

import ProductsList from './components/products/ProductsList.vue'

import MyShop from './components/shop/MyShop.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: ProductsList },
    { path: '/my-cart', component: MyShop },
  ],
  linkActiveClass: 'active'
});

export default router;