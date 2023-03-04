import { createStore } from 'vuex'

import { productsStore } from './products-store';

import { shopStore } from './shop-store';

import createPersistedState from "vuex-persistedstate";

const store = createStore({
  plugins: [createPersistedState()],
  modules: {
    productsStore,
    shopStore
  }
});

export default store;