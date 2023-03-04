<template>
  <div v-if="isFetching" class="w-full h-full">
    <the-spinner />
  </div>
  <div v-else>
    <h2 class="text-center font-semibold text-xl pb-8">Products List</h2>
    <div class="gap-4 grid grid-cols-3">
      <product-item
        v-for="product in products"
        :key="product.id"
        :product="product"
        @addProductToCart="addProductToCart"
        @removeProductFromCart="removeProductToCart"
       />
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
        myCartProducts: [],
        isFetching: false,
        isSaving: false,
        isDeleting: false,
      }
    },

    methods: {
      async fetchAllProducts() {
        this.isFetching = true;
        const data = await this.$store.dispatch('fetchAllProducts');
        const fetchedProducts = await data;
        const userId = this.$store.getters.getUser;
        const myCartProducts = await this.$store.dispatch('fetchMyCartProducts', [userId]);
        this.products = fetchedProducts;
        this.myCartProducts = myCartProducts;
        console.log(myCartProducts);
        this.isFetching = false;        
      },
      async addProductToCart(productId) {
        this.isSaving = true;
        const userId = this.$store.getters.getUser;
        await this.$store.dispatch('addProductToCart', {
          'userId': userId, 'productId': productId
        });
        location.reload();
        this.isSaving = false;
      },
      async removeProductToCart(productId) {
        this.isDeleting = true;
        const userId = this.$store.getters.getUser;
        await this.$store.dispatch('removeProductFromCart', {
          'userId': userId, 'productId': productId
        });
        location.reload();
        this.isDeleting = false;
      },
    },
    computed: {
      getStoreProducts() {
        return this.$store.getters.getProducts;
      },
    },
    mounted() {
      this.fetchAllProducts();
    }
  }
</script>