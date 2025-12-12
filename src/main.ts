import './assets/main.css'

import { createApp, onMounted } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import { initFlowbite } from 'flowbite'

import router from './router'
const app = createApp(App)
app.use(router)
onMounted(() => {
    initFlowbite();
})
app.use(createPinia())

app.mount('#app')
