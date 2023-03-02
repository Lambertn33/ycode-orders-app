require('./bootstrap')

import { createApp } from 'vue'

import { createStore } from 'vuex'

import router from './router'

import TheNavbar from './components/navbar/TheNavbar.vue'

import App from './components/App'

const store = createStore({})

const app = createApp(App)

app.use(store)

app.use(router)

app.component('the-navbar', TheNavbar);

app.mount('#app')
