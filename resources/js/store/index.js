import { createStore } from 'vuex'

import { productsStore } from './products-store';

import createPersistedState from "vuex-persistedstate"

const store = createStore({
  plugins: [createPersistedState],
  modules: {
    productsStore
  }
});

export default store;