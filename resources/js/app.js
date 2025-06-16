import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AppLayout from './Layouts/AppLayout.vue'
import GuestLayout from './Layouts/GuestLayout.vue'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page = pages[`./Pages/${name}.vue`]
    
    /*
    // Asignar el layout por defecto si no está definido
    if (page.default.layout === undefined) {
      page.default.layout = AppLayout
    }
    else {
      page.default.layout = GuestLayout
    }
      */
    // Asignar layout según la ruta
    if (name.startsWith('Auth/')) {
      page.default.layout = GuestLayout
    } else {
      page.default.layout = AppLayout
    }
    
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})