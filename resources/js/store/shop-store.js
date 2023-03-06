import ShopServices from "../services/shop.services";

let initialState = {
  newOrderFields: [],
  myCartProducts: [],
  orderInfo: {
    userShippingInfo: {},
  },
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

    fetchMyCartProducts({ commit }, userId) {
      return ShopServices.getMyCartProducts(userId).then(
        response => {
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      )
    },

    setUserInfo({ commit }, userShippingInfo) {
      commit('setUserShippingInfo', userShippingInfo);
    },

    addProductToCart({ commit }, {userId, productId}) {
      return ShopServices.addProductToCart(userId, productId).then(
        response => {
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      );
    },
    removeProductFromCart({ commit }, {userId, productId}) {
      return ShopServices.removeProductFromCart(userId, productId).then(
        response => {
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      );
    },
  },


  mutations: {
    setNewOrderFields(state, fields) {
      state.newOrderFields = fields;
    },
    setUserShippingInfo(state, userShippingInfo) {
      state.orderInfo.userShippingInfo = userShippingInfo;
    },
  },

  getters: {
    getNewOrderFields(state) {
      return state.newOrderFields;
    },
    getMyCartProducts(state) {
      return state.myCartProducts;
    },
    getUserShippingInfo(state) {
      return state.orderInfo.userShippingInfo;
    }

  }
}