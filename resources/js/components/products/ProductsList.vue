<template>
  <div v-if="isFetching" class="w-full h-full">
    <the-spinner />
  </div>
  <div v-else>
    <h2 class="text-center font-semibold text-xl pb-8">Products List</h2>
    <the-alert v-show="hasRequestFinished" :responseMessage="responseMessage"/>
    <div class="gap-4 grid grid-cols-3">
      <product-item
        v-for="product in products"
        :key="product.id"
        :product="product"
        @addProductToCart="addProductToCart"
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
        hasRequestFinished: false,
        isDeleting: false,
        isFetching: false,
        isModalVisible: false,
        isSaving: false,
        myCartProducts: [],
        products: [],
        responseMessage: '',
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
        this.isFetching = false;        
      },

      async addProductToCart(productId) {
        this.isSaving = true;
        const userId = this.$store.getters.getUser;
        const response = await this.$store.dispatch('addProductToCart', {
          'userId': userId, 'productId': productId
        });
        this.responseMessage = response.message;
        this.isSaving = false;
        this.hasRequestFinished = true;
        setTimeout(function(){
          location.reload();
        }, 2000);
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