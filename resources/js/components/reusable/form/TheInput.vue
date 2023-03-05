<template>
  <div>
    <label :for="label" class="block text-sm font-semibold text-gray-700">{{ label }}</label>
    <div class="mt-1">
      <input 
        :type="type" 
        :id="label"
        required
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      type: String,
      label: String
    }
  }
</script>