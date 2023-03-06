<template>
  <div class="ml-4">
    <label for="quantity" class="sr-only">Quantity</label>
    <select id="quantity"
      name="quantity"
      class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
      v-bind="setSelectEnabledOrDisabled"  
    >
      <option v-for="quantity in maxQuantityToSelect" :key="quantity" :value="i">{{ quantity }}</option>
    </select>
  </div>
</template>

<script>
  export default {
    props: {
      label: String,
      maxQuantityToSelect: Number,
      isShippingInformationFilled: Boolean
    },
    computed: {
      setSelectEnabledOrDisabled() {
        // if user has not yet validated the shipping information form, he can't select the quantity
        return !this.isShippingInformationFilled ? { disabled: true } : '';
      }
    }
  }
</script>

<style>
  select:disabled {
    background-color:#d9d9d9;
  }
</style>