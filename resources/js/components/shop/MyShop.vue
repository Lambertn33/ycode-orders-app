<template>
  <div v-if="isFetching" class="w-full h-full">
    <the-spinner />
  </div>
  <div v-else>
    <error-alert v-show="hasError" :errorMessage="errorMessage"/>
    <h2 class="sr-only">Checkout</h2>
    <form v-on:submit.prevent="submitOrder" v-if="myCartProducts.length" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
      <order-form 
        :newOrderFields="newOrderFields"
        :myCartProducts="myCartProducts"
      />

      <my-cart 
        :myCartProducts="myCartProducts" 
        @removeProductFromCart="removeProductFromCart"
      />
    </form>
    <div class="p-16 flex items-center justify-center bg-gray-200 rounded-md" v-else>
      <h2 class="text-red-600 text-xl font-bold">Your cart is empty</h2>
    </div>
  </div>
</template>

<script>
  import OrderForm from './OrderForm.vue';
  import MyCart from './MyCart.vue';

  export default {
    components: { OrderForm, MyCart },
    data() {
      return {
        isFetching: false,
        hasError: false,
        errorMessage: '',
        newOrderFields: [],
        myCartProducts: [],
      }
    },
    methods: {
      async fetchNewOrderFieldsAndMyCart() {
        try {
          this.isFetching = true;
          // fetch new order fields
          const fields = await this.$store.dispatch('fetchNewOrderFields');
          const { fields: fetchedFields } = await fields;

          // avoid rendering inputs with reference types
          const filteredFields = fetchedFields.filter((field) => {
            return field.type != "reference";
          });

          // some fields have type of phone instead of tel and datetime instead of datetime-local
          // we manually fix this
          for (const field of filteredFields) {
            if (field.type == "datetime") field.type = "datetime-local";
            if (field.type == "phone") field.type = "tel";
          }

          // fetch my cart
          const userId = this.$store.getters.getUser;
          const myCartProducts = await this.$store.dispatch('fetchMyCartProducts', [userId]);
          this.myCartProducts = this.displayProductsInCartBasedOnId(myCartProducts);
          this.newOrderFields = filteredFields;
          this.isFetching = false; 
        } catch (error) {
          this.isFetching = false;
          this.hasError = true;
          this.errorMessage = error.message;
        }       
      },

      async submitOrder() {
        console.log('order submitted');
      },
      
      async removeProductFromCart(productId) {
        const userId = this.$store.getters.getUser;
        await this.$store.dispatch('removeProductFromCart', {
          'userId': userId, 'productId': productId
        });
        setTimeout(function(){
          location.reload();
        }, 2000);
      },

      // since in the DB we only save the product ID, we first find the product corresponding to each fetched product
      displayProductsInCartBasedOnId(products) {
        const filteredProducts = [];
        const productsInStore = this.$store.getters.getProducts;
        for (const product of products) {
          const actualProduct = productsInStore.filter((p) => {
            return p.ID == product.product_id
          });
          filteredProducts.push(actualProduct);
        }
        return filteredProducts;
      },      
    },
    computed: {
      getNewOrderFields() {
        return this.$store.getters.getNewOrderFields;
      },   
    },
    mounted() {
      this.fetchNewOrderFieldsAndMyCart();
    },
  }
</script>