<template>
  <div>
    <label :for="label" class="block text-sm font-semibold text-gray-700">{{ label }}</label>
    <div class="mt-1">
      <input 
        :type="type" 
        :id="label"
        @input="$emit('changeValue', $event.target.value, $event.target.id)"
        v-bind="setInputEnabledOrDisabled"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>
  </div>
</template>

<script>
  export default {
    emits: ['changeValue'],
    props: {
      type: String,
      label: String,
      value: String,
      orderToSubmit: Object,
      isShippingInformationFilled: Boolean
    },
    computed: {
      setInputEnabledOrDisabled() {
        // if user has validated the shipping information form, the inputs should be disabled
        return this.isShippingInformationFilled ? { disabled: true } : '';
      }
    },
  }
</script>

<style>
  input:disabled {
    background-color:#d9d9d9;
  }
</style>