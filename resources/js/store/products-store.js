import ProductsServices from "../services/products.services";

let initialState = {
  products: []
}

export const productsStore = {
  state: initialState,

  actions: {
    fetchAllProducts({ commit }) {
      return ProductsServices.getAllProducts().then(
        response => {
          commit('setProducts', response.data);
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      )
    }
  },

  mutations: {
    setProducts(state, products) {
      state.products = products;
    }
  },

  getters: {
    getProducts(state) {
      return state.products;
    }
  }
}