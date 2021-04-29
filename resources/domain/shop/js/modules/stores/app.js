import Vue from 'vue'
import ShopLocations from './components/ShopLocations'

window.eventBus = new Vue({})

new Vue({
  el: '#stores',
  components: { ShopLocations }
})
