import Vue from 'vue'
import ProductConfig from './components/ProductConfig'

window.eventBus = new Vue({})

new Vue({
  el: '#product',
  components: { ProductConfig }
})
