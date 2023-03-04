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
      <button v-if="!checkProductExistence" type="button" @click="$emit('addProductToCart', product.ID)"
         class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
          focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex
           items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

        <svg aria-hidden="true"
          class="w-5 h-5 mr-2 -ml-1"
          fill="currentColor" 
          viewBox="0 0 20 20" 
          xmlns="http://www.w3.org/2000/svg">
          <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74
            11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017
            3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
          </path>
        </svg>
        Add to cart
      </button>
      <button v-else @click="$emit('removeProductFromCart', product.ID)"  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none
        focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex
        items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
          Remove from cart
      </button>
    </div>
  </div>
</template>

<script>
  export default {
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
    created() {
      this.fetchMyCartProducts();
    }
  }
</script>