require('./bootstrap')

import { createApp } from 'vue'
import { createStore } from 'vuex'

import TheNavbar from './components/navbar/TheNavbar.vue'

import App from './components/App'

const store = createStore({})

const app = createApp(App)

app.use(store)

app.component('the-navbar', TheNavbar);

app.mount('#app')
