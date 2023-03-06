require('./bootstrap')

import { createApp } from 'vue'

import VueSweetalert2 from 'vue-sweetalert2'

import router from './router'

import store from './store'

import TheNavbar from './components/navbar/TheNavbar.vue'

import TheSpinner from './components/reusable/TheSpinner.vue'

import App from './components/App'

import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App)

app.use(store)

app.use(router)

app.component('the-navbar', TheNavbar)

app.component('the-spinner', TheSpinner)

app.use(VueSweetalert2)

app.mount('#app')
