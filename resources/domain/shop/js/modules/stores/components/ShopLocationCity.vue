<template>
  <div class="city" :class="{ 'city--active': active }">
    <div class="city__info">
      <div class="city__name">
        {{ city.name}}
      </div>

      <div class="city__here" v-if="active">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="city__here__icon">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Вы здесь
      </div>
    </div>

    <div class="city__stores">
      <shop-location-store v-for="store in city.stores" :key="store.id" :store="store"/>
    </div>
  </div>
</template>

<script>
  import ShopLocationStore from './ShopLocationStore'

  export default {
    name: 'ShopLocationCity',
    components: { ShopLocationStore },
    props: {
      city: Object,
      required: true,
    },
    computed: {
      active () {
        return this.$parent.currentCity.id === this.city.id
      },
    },
    created () {
      if (this.active && !this.$parent.currentStore) {
        window.eventBus.$emit('change-store', this.city.stores[0])
      }
    },
  }
</script>
