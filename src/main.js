import Vue from 'vue'
import helper from '@/plugins/helper'
import App from '@/App.vue'
import '@/plugins/vuetify'
import '@/components'
import axios from 'axios'
import VueAxios from 'vue-axios'
import InfiniteLoading from 'vue-infinite-loading'
// import CoolLightBox from 'vue-cool-lightbox'
// import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
import VuePictureSwipe from 'vue-picture-swipe'
import 'photoswipe/dist/default-skin/default-skin.css'

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
// Vue.use(CoolLightBox)
Vue.component('vue-picture-swipe', VuePictureSwipe)

new Vue({ render: (h) => h(App) }).$mount('#app')
