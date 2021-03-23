import Vue from 'vue'
import helper from '@/plugins/helper'
import App from '@/App.vue'
import '@/plugins/vuetify'
import '@/components'
import axios from 'axios'
import VueAxios from 'vue-axios'
import InfiniteLoading from 'vue-infinite-loading'

Vue.config.productionTip = false
Vue.use(helper)
Vue.use(VueAxios, axios)
Vue.use(InfiniteLoading, {
  props: {
    spinner: 'spiral',
    /* other props need to configure */
  },
  system: {
    throttleLimit: 50,
    /* other settings need to configure */
  },
  slots: {
    // keep default styles
    noResults: 'No more data',
  },
})

new Vue({ render: (h) => h(App) }).$mount('#app')
