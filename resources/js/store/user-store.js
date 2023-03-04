let initialState = {
  userId: ''
}

//create fake User ID for identify the current user which is in the current session
export const userStore = {
  state: initialState,

  actions: {
    setUser({ commit }, userId) {
      commit('setUser', userId);
    }
  },

  mutations: {
    setUser(state, userId) {
      state.userId = userId;
    }
  },
  getters: {
    getUser(state) {
      return state.userId;
    }
  }
}