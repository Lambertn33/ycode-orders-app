import ShopServices from "../services/shop.services";

let initialState = {
  newOrderFields: [],
  myCartProducts: []
}

export const shopStore = {
  state: initialState,

  actions: {
    fetchNewOrderFields({ commit }) {
      return ShopServices.getOrdersFields().then(
        response => {
          const { fields } = response.data;
          commit('setNewOrderFields', fields);
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      )
    },
    fetchMyCartProducts({ commit }) {
      return ShopServices.getMyCartProducts().then(
        response => {
          return Promise.resolve(response);
        },
        error => {
          return Promise.reject(error);
        }
      )
    }
  },

  mutations: {
    setNewOrderFields(state, fields) {
      state.newOrderFields = fields;
    }
  },

  getters: {
    getNewOrderFields(state) {
      return state.newOrderFields;
    }
  }
}