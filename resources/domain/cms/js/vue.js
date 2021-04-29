import Vue from 'vue'
import CmsUploader from './components/CmsUploader'
import CmsUploaderGallery from './components/CmsUploaderGallery'

window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.EventBus = new Vue()

window.app = new Vue({
  el: '#app',
  components: {
    CmsUploader,
    CmsUploaderGallery,
  }
})
