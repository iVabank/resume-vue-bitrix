import Vue from 'vue'
import helper from '@/plugins/helper'
import App from '@/App.vue'
import '@/plugins/vuetify'
import '@/components'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.config.productionTip = false
Vue.use(helper)
Vue.use(VueAxios, axios)

new Vue({ render: (h) => h(App) }).$mount('#app')
