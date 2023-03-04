import { createStore } from 'vuex'

import { productsStore } from './products-store';

import { shopStore } from './shop-store';

import { userStore } from './user-store';

import createPersistedState from "vuex-persistedstate";

const store = createStore({
  plugins: [createPersistedState()],
  modules: {
    productsStore,
    shopStore,
    userStore
  }
});

export default store;