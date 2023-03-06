<template>
  <div class="mt-10 lg:mt-0">
    <h2 class="text-lg font-medium text-gray-900">Order summary</h2>
    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
      <h3 class="sr-only">Items in your cart</h3>
      <ul role="list" class="divide-y divide-gray-200 overflow-y-auto">
        <li class="flex py-6 px-4 sm:px-6" v-for="product in orderObject.orderedProducts" :key="product.id">
          <div class="flex-shrink-0">
            <img :src="product.image" alt="T-Shirt in black." class="w-20 rounded-md">
          </div>

          <div class="ml-6 flex flex-1 flex-col">
            <div class="flex justify-between">
              <div class="min-w-0 flex-1">
                <h4 class="text-sm">
                  <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{ product.name }}</a>
                </h4>
                <p class="mt-1 text-sm text-gray-500">{{ product.color }}</p>
              </div>
              <div v-if="isShippingInformationFilled">
                <span @click="$emit('removeProductFromCart', product.id)" class="text-red-500 font-bold cursor-pointer">
                  <remove-icon />
                </span>
              </div>
            </div>
            <div class="flex flex-1 items-end justify-between pt-2">
              <p class="mt-1 text-sm font-medium text-gray-900">${{ product.price }}</p>
              <the-select
                :label="inputSelectComponents.label"
                :maxQuantityToSelect="inputSelectComponents.maxQuantityToSelect"
                :isShippingInformationFilled="isShippingInformationFilled"
                :id="product.id"
                @changeSelectedQuantity="changeSelectedQuantity"
              />
            </div>
            <div class="flex flex-1 items-end justify-between pt-2">
              <p class="mt-1 text-sm font-extrabold text-gray-900">Subtotal</p>
              <p class="mt-1 text-sm font-extrabold text-gray-900">${{ formatAmount(product.subTotal) }}</p>
            </div>
          </div>
        </li>
      </ul>
      <div>
        <dl class="space-y-6 border-t border-gray-200 py-6 px-4 sm:px-6">
          <div class="flex items-center justify-between">
            <dt class="text-sm font-extrabold">Grand subtotal</dt>
            <dd class="text-sm font-extrabold text-gray-900">$ {{ formatAmount(orderObject.grandSubTotal) }}</dd>
          </div>
          <div class="flex items-center justify-between">
            <dt class="text-sm font-extrabold">Shipping</dt>
            <dd class="text-sm font-extrabold text-gray-900">$ {{ formatAmount(orderObject.shippingFee) }}</dd>
          </div>
          <div class="flex items-center justify-between border-t border-gray-200 pt-6">
            <dt class="text-base font-extrabold">Grand total</dt>
            <dd class="text-base font-extrabold text-gray-900">$ {{ formatAmount(orderObject.grandTotal) }}</dd>
          </div>
        </dl>

        <div class="py-6 px-4 sm:px-6" v-if="isShippingInformationFilled">
          <button
            type="button"
            @click="$emit('submitOrder', this.orderObject)"
            class="w-full rounded-md border border-transparent bg-indigo-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
            Submit order
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import TheSelect from '../reusable/form/TheSelect.vue';
  import RemoveIcon from 'vue-material-design-icons/Close.vue';

  export default {
    data() {
      return {
        inputSelectComponents: {
          label: 'Quantity',
          //the max quantity to select we set it to 7 but can be any number
          maxQuantityToSelect: 7,
          // the shipping fee is always 5
        },
        orderObject: {
          orderedProducts: [],
          shippingFee: 5,
          grandSubTotal: 0,
          grandTotal: 0
        }
      }
    },
    components: { TheSelect, RemoveIcon },
    emits: ['removeProductFromCart', 'submitOrder'],
    props: {
      myCartProducts: Array,
      isShippingInformationFilled: Boolean,
    },

    methods: {
      changeSelectedQuantity(selectedProductId, selectedQuantity) {
        const { orderedProducts } = this.orderObject;
        const selectedProductIndex = orderedProducts.findIndex((product => product.id == selectedProductId));
        let selectedProduct = orderedProducts[selectedProductIndex];
        selectedProduct.quantity = parseInt(selectedQuantity);
        selectedProduct.subTotal = parseInt(selectedQuantity) * selectedProduct.price;
        this.calculateTotals();
      },

      calculateTotals() {
        const { orderedProducts } = this.orderObject;
        let subTotal = 0;
        for (const product of orderedProducts) {
          subTotal+= product.subTotal;
        }
        this.orderObject.grandSubTotal = subTotal;
        this.orderObject.grandTotal = subTotal + this.orderObject.shippingFee;
      }
    },
    computed: {
      formatAmount() {
        return amount =>  amount.toFixed(2);
      },
      formatRemoveButtonLabel() {
        return this.isRemovingProduct ? 'Please wait...' : 'Remove';
      }
    },

    mounted() {
      for (const product of this.myCartProducts) {
        const productInCart = {};
        productInCart.id = product[0].ID;
        productInCart.price = parseInt(product[0].Price);
        productInCart.quantity = 1;
        productInCart.name = product[0].Name;
        productInCart.image = product[0].Image;
        productInCart.color = product[0].Color;
        productInCart.subTotal = productInCart.quantity * productInCart.price;
        this.orderObject.orderedProducts.push(productInCart);
        this.calculateTotals();
      }
    }
  }
</script>