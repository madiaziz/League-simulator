import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: '#8E44AD',
                secondary: '#1ABC9C',
                accent: '#8c9eff',
                error: '#C0392B',
            },
        },
    },
})