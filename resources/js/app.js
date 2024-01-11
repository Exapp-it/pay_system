import './main.js';
import '../css/app.css'

import {createApp, h} from 'vue'
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import {createInertiaApp} from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        return pages[`./Pages/${name}.vue`]
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
    progress: {
        delay: 250,
        color: '#16a34a',
        includeCSS: true,
        showSpinner: true,
    }
})

