<template>
  <div class="max-w-sm rounded overflow-hidden shadow-lg">
    <img class="w-full" :src="product.Image" alt="Sunset in the mountains">
    <div class="px-6 py-4 bg-gray-200 flex flex-col gap-4">
      <div class="flex justify-between">
        <div class="font-bold text-xl mb-2">{{ product.Name }}</div>
        <p class="text-gray-700 text-base">
        Slug: {{ product.Slug }}
        </p>
      </div>
      <hr>
      <div class="flex justify-between">
        <div class="font-bold text-xl mb-2">${{ product.Price }}</div>
        <p class="text-gray-700 text-base">
        Color: {{ product.Color }}
        </p>
      </div>
    </div>
    <div class="px-6 py-4 flex items-center">
      <button v-if="checkProductExistence" @click="$emit('removeProductFromCart', product.ID)"  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none
        focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex gap-2
        items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
          <cart-icon />
          Remove from cart
      </button>
      <button v-else type="button" @click="$emit('addProductToCart', product.ID)"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
        focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex gap-2
        items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <cart-icon />        
        Add to cart
      </button>
    </div>
  </div>
</template>

<script>
import CartIcon from 'vue-material-design-icons/Cart.vue';
  export default {
    components: { CartIcon },
    data() {
      return {
        myCartProducts: [],
      }
    },
    emits: ['addProductToCart', 'removeProductFromCart'],
    props: {
      product: Object,
    },
    methods: {
      async fetchMyCartProducts() {
        const userId = this.$store.getters.getUser;
        const myCartProducts = await this.$store.dispatch('fetchMyCartProducts', [userId]);
        this.myCartProducts = myCartProducts;
      },
    },
    computed: {
      checkProductExistence() {
        return this.myCartProducts.some(prod => prod.product_id == this.product.ID);
      }
    },
    mounted() {
      this.fetchMyCartProducts();
    }
  }
</script>