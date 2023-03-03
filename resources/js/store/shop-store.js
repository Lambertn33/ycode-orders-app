import OrdersServices from "../services/orders.services";

let initialState = {
  newOrderFields: []
}

export const shopStore = {
  state: initialState,

  actions: {
    fetchNewOrderFields({commit}) {
      return OrdersServices.getOrdersFields().then(
        response => {
          const { fields } = response.data;
          commit('setNewOrderFields', fields);
          return Promise.resolve(response.data);
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