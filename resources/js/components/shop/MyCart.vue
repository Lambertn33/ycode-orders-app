<template>
  <div v-if="isFetching" class="w-full h-full">
    <the-spinner />
  </div>
  <div v-else>
    <h2 class="text-center font-semibold text-xl pb-8">My Cart</h2>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        isFetching: false,
        newOrderFields: []
      }
    },
    methods: {
      async fetchNewOrderFields() {
        if (this.getNewOrderFields.length) {
          this.newOrderFields = this.getNewOrderFields;
        } else {
          this.isFetching = true;
          const data = await this.$store.dispatch('fetchNewOrderFields');
          const fetchedFields = await data;
          this.newOrderFields = fetchedFields;
          this.isFetching = false;        
        }
      }
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