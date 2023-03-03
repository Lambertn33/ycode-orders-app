<template>
  <nav class="flex justify-between w-full bg-indigo-600 p-6 absolute left-0 right-0 top-0">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <span class="font-semibold text-xl tracking-tight">Ycode Shopping App</span>
    </div>
    <div class="block flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="flex gap-2 text-sm lg:flex-grow">
        <div class="flex gap-2 items-center nav-item" v-for="link in navLinks" :key="link.name">
          <component :is="link.icon" class="text-white" />
          <router-link :to="link.href"  class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
            {{ link.name }}
          </router-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
  import ShopIcon from 'vue-material-design-icons/Shopping.vue';
  import CartIcon from 'vue-material-design-icons/Cart.vue';

  export default {
    components: { ShopIcon, CartIcon },
    data() {
      return {
        navLinks: [
          {
            name: 'Products List',
            href: '/',
            icon: 'shop-icon'
          },
          {
            name: 'My Cart',
            href: "/my-cart",
            icon: 'cart-icon'
          },
        ]
      }
    }
  }
</script>

<style>
.nav-item:hover {
  font-weight: 800;
  font-size: medium;
  transition: .3s;
}
</style>