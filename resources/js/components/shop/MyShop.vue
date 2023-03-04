<template>
  <div v-if="isFetching" class="w-full h-full">
    <the-spinner />
  </div>
  <div v-else>
        <h2 class="sr-only">Checkout</h2>

        <form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <order-form :newOrderFields="newOrderFields" />
            <my-cart />
        </form>
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
        newOrderFields: [],
        myCartProducts: [],
      }
    },
    methods: {
      async fetchNewOrderFields() {
        if (this.getNewOrderFields.length) {
          this.newOrderFields = this.getNewOrderFields;          
        } else {
          this.isFetching = true;
          // fetch new order fields
          const fields = await this.$store.dispatch('fetchNewOrderFields');

          // fetch my cart
          const myCartProducts = await this.$store.dispatch('fetchMyCartProducts');
          console.log('mycart', myCartProducts);
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
          this.newOrderFields = filteredFields;
          this.isFetching = false;        
        }
      },

      
    },
    computed: {
      getNewOrderFields() {
        return this.$store.getters.getNewOrderFields;
      }    
    },
    mounted() {
      this.fetchNewOrderFields();
    }
  }
</script>