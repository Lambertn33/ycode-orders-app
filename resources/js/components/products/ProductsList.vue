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
        hasError: false,
        errorMessage: '',
        isDeleting: false,
        isFetching: false,
        isSaving: false,
        myCartProducts: [],
        products: [],
        responseMessage: '',
      }
    },

    methods: {
      async fetchAllProducts() {
        try {
          this.isFetching = true;
          const data = await this.$store.dispatch('fetchAllProducts');
          const fetchedProducts = await data;
          const userId = this.$store.getters.getUser;
          const myCartProducts = await this.$store.dispatch('fetchMyCartProducts', [userId]);
          this.products = fetchedProducts;
          this.myCartProducts = myCartProducts;
          this.isFetching = false;    
        } catch (error) {
          this.isFetching = false;
          this.hasError = true;
          this.errorMessage = error.message;
        }    
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
        this.$swal({title: 'Success', text: response.message, type: 'success'}).then(okay => {
          if( okay) {
            location.reload();
          }
        });
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