<template>
  <div class="ml-4">
    <label for="quantity" class="sr-only">Quantity</label>
    <select
      @change="$emit('changeSelectedQuantity', $event.target.id, $event.target.value)"
      :id="id"
      name="quantity"
      class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
      v-bind="setSelectEnabledOrDisabled"  
    >
      <option v-for="quantity in maxQuantityToSelect" :key="quantity" :value="quantity">{{ quantity }}</option>
    </select>
  </div>
</template>

<script>
  export default {
    emits: ['changeSelectedQuantity'],
    props: {
      label: String,
      id: String,
      maxQuantityToSelect: Number,
      isShippingInformationFilled: Boolean,
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