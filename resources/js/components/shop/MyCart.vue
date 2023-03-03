<template>
  <div class="mt-10 lg:mt-0">
    <h2 class="text-lg font-medium text-gray-900">Order summary</h2>
    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
      <h3 class="sr-only">Items in your cart</h3>
      <ul role="list" class="divide-y divide-gray-200">
        <li class="flex py-6 px-4 sm:px-6">
          <div class="flex-shrink-0">
            <img src="/images/t-shirt-black.jpg" alt="T-Shirt in black." class="w-20 rounded-md">
          </div>

          <div class="ml-6 flex flex-1 flex-col">
            <div class="flex">
              <div class="min-w-0 flex-1">
                <h4 class="text-sm">
                  <a href="#" class="font-medium text-gray-700 hover:text-gray-800">Basic Tee</a>
                </h4>
                <p class="mt-1 text-sm text-gray-500">Black</p>
              </div>
            </div>
            <div class="flex flex-1 items-end justify-between pt-2">
              <p class="mt-1 text-sm font-medium text-gray-900">$32.00</p>
              <div class="ml-4">
                <label for="quantity" class="sr-only">Quantity</label>
                <select id="quantity" name="quantity" class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                   <option value="1">0</option>
                </select>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <dl class="space-y-6 border-t border-gray-200 py-6 px-4 sm:px-6">
        <div class="flex items-center justify-between">
          <dt class="text-sm">Subtotal</dt>
          <dd class="text-sm font-medium text-gray-900">$64.00</dd>
        </div>
        <div class="flex items-center justify-between">
          <dt class="text-sm">Shipping</dt>
          <dd class="text-sm font-medium text-gray-900">$5.00</dd>
        </div>
        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
          <dt class="text-base font-medium">Total</dt>
          <dd class="text-base font-medium text-gray-900">$69.00</dd>
        </div>
      </dl>

      <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
        <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Submit order</button>
      </div>
    </div>
  </div>
</template>