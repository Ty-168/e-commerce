import './assets/main.css'

import { createApp, onMounted } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import { initFlowbite } from 'flowbite'


const app = createApp(App)

onMounted(() => {
    initFlowbite();
})
app.use(createPinia())

app.mount('#app')
