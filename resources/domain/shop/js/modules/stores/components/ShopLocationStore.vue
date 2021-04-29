<template>
  <div class="store" :class="{ 'store--active': active }" @click="changeStore">
    <div class="store__address">
      {{ store.address }}
    </div>

    <div class="store__address-details" v-if="store.address_details">
      {{ store.address_details }}
    </div>

    <div class="store__working-hours">
      {{ store.working_hours }}
    </div>

    <div class="store__phone">
      <a :href="`tel:${store.phone.replace(/[^0-9]/g, '')}`">
        {{ store.phone }}
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ShopLocationStore',
  props: {
    store: {
      type: Object,
      required: true,
    },
  },
  computed: {
    active () {
      return this.$parent.$parent.currentStore?.id === this.store.id
    },
  },
  methods: {
    changeStore () {
      window.eventBus.$emit('change-store', this.store)
    },
  },
}
</script>
