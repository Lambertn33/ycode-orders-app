<template>
  <div>
    <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>
    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm p-6">

      <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
        <the-input
          v-for="field in newOrderFields"
          :key="field.id"
          :type="field.type"
          :label="field.name"
        />  
      </div>
    </div>
  </div>
</template>

<script>
  import TheInput from '../reusable/form/TheInput.vue';
  export default {
    components: { TheInput },
    props: {
      newOrderFields: Array
    }
  }
</script>