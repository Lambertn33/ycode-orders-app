require('./bootstrap')

import { createApp } from 'vue'

import router from './router'

import store from './store'

import TheAlert from './components/reusable/TheAlert.vue'

import TheNavbar from './components/navbar/TheNavbar.vue'

import TheSpinner from './components/reusable/TheSpinner.vue'

import App from './components/App'

const app = createApp(App)

app.use(store)

app.use(router)

app.component('the-navbar', TheNavbar)

app.component('the-alert', TheAlert)

app.component('the-spinner', TheSpinner)

app.mount('#app')
