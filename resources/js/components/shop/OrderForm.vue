<template>
  <div>
    <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>
    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm p-6">
      <span class="text-red-600 text-sm font-bold">
        Note: after filling the shipping information, please validate the form in Order to fill out the cart..
        you can invalidate your data and start over if your information is not complete
      </span>
      <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
        <the-input
          v-for="field in newOrderFields"
          :key="field.id"
          :type="field.type"
          :label="field.name"
          :orderToSubmit="orderToSubmit"
          @changeValue = "changeValue"
          :isShippingInformationFilled="isShippingInformationFilled"
        />  
      </div>
      <div class="py-4 px-4 sm:px-6">
        <button @click="$emit('validateOrInvalidateForm', this.orderToSubmit.userInfo)" type="button" 
        :class="renderButtonClasses">
        {{ renderButtonLabel }}
      </button>
      </div>
    </div>
  </div>
</template>

<script>
  import TheInput from '../reusable/form/TheInput.vue';
  export default {
    components: { TheInput },
    data() {
      return {
        orderToSubmit: {},
      }
    },
    props: {
      newOrderFields: Array,
      validateOrInvalidateForm: Function,
      isShippingInformationFilled: Boolean
    },
    emits: ['validateOrInvalidateForm'],
    methods: {
      changeValue(enteredValue, id) {
        for (const key of Object.keys(this.orderToSubmit.userInfo)) {
          if (key == id) {
            this.orderToSubmit.userInfo[key] = enteredValue;
          }
        }
      }
    },
    computed: {
      renderButtonLabel() {
        return !this.isShippingInformationFilled ? 'Validate Information' : 'Invalidate Information'
      },
      renderButtonClasses() {
        let btnClasses = "w-full rounded-md border border-transparent py-3 px-4 text-base font-medium text-white shadow-sm  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50";
        btnClasses += !this.isShippingInformationFilled ? " bg-indigo-600 hover:bg-indigo-700" : " bg-indigo-300 hover:bg-indigo-400"
        return btnClasses
      }
    },
    mounted() {
      //initialize dynamically empty order object to submit since the inputs are dynamic too
      const object = new Object();
      for (const field of this.newOrderFields) {
        const fieldName = field.name;
        object[fieldName] = '';
      }
      this.orderToSubmit['userInfo'] = object;
    }
  }
</script>