<template>
  <div v-if="isFetching" class="w-full h-full">
    <the-spinner />
  </div>
  <div v-else>
    <h2 class="text-center font-semibold text-xl pb-8">Products List</h2>
    <div class="gap-4 grid grid-cols-3">
      <product-item v-for="product in products" :key="product.id" :product="product" />
    </div>
  </div>
</template>

<script>
  import ProductItem from './ProductItem.vue';

  export default {
    components: { ProductItem },
    data() {
      return {
        products: [],
        isFetching: false,
      }
    },

    methods: {
      async fetchAllProducts() {
        if (this.getStoreProducts.length) {
          this.products = this.getStoreProducts;
        } else {
          this.isFetching = true;
          const data = await this.$store.dispatch('fetchAllProducts');
          const fetchedProducts = await data;
          this.products = fetchedProducts;
          this.isFetching = false;        
        }
      }
    },
    computed: {
      getStoreProducts() {
        return this.$store.getters.getProducts;
      }    
    },
    mounted() {
      this.fetchAllProducts();
    }
  }
</script>