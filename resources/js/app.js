require('./bootstrap')

import { createApp } from 'vue'

import router from './router'

import store from './store'

import SuccessAlert from './components/reusable/SuccessAlert.vue'

import ErrorAlert from './components/reusable/ErrorAlert.vue'

import TheNavbar from './components/navbar/TheNavbar.vue'

import TheSpinner from './components/reusable/TheSpinner.vue'

import App from './components/App'

const app = createApp(App)

app.use(store)

app.use(router)

app.component('the-navbar', TheNavbar)

app.component('success-alert', SuccessAlert)

app.component('error-alert', ErrorAlert)

app.component('the-spinner', TheSpinner)

app.mount('#app')
