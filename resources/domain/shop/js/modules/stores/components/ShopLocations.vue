<template>
  <div class="stores__grid">
    <div class="stores__cities">
      <shop-location-city v-for="city in cities" :key="city.id" :city="city"/>
    </div>

    <div class="stores__map">
      <iframe :src="yandexMapEmbedUrl" frameborder="0"/>
    </div>
  </div>
</template>

<script>
import ShopLocationCity from './ShopLocationCity'

export default {
  name: 'ShopLocations',
  components: { ShopLocationCity },
  props: {
    currentCity: {
      type: Object,
      required: true,
    },
    cities: {
      type: Array,
      required: true,
    },
  },
  created () {
    window.eventBus.$on('change-store', this.changeStore)
  },
  data () {
    return {
      currentStore: null,
    }
  },
  computed: {
    yandexMapEmbedUrl () {
      if (!this.currentStore) {
        return ''
      }

      return this.currentStore.map_embed
        .replace('yandex.', 'api-maps.yandex.')
        .replace('/maps/', '/frame/v1/')
        .replace('.kz', '.ru')
    }
  },
  methods: {
    changeStore (store) {
      this.currentStore = store
    },
  },
}
</script>
