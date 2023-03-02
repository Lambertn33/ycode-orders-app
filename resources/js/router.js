import { createRouter, createWebHistory } from "vue-router"

import ProductsList from './components/products/ProductsList.vue'

import MyCart from './components/shop/MyCart.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: ProductsList },
    { path: '/my-cart', component: MyCart },
  ],
  linkActiveClass: 'active'
});

export default router;