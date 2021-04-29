<template>
  <div v-if="items.length">
    <div class="section" v-for="city in cities">
      <div class="section__heading">
        <div class="section__title">
          Остатки {{ city.name }}
        </div>
      </div>

      <div class="packing-grid field" v-for="remain in filterRemains(city.id)">
        <input type="text" disabled :value="remain.packing.name">
        <input type="text" disabled :value="remain.taste.name">

        <input type="number" required v-model="remain.quantity" placeholder="Кол-во">
      </div>
    </div>

    <input type="hidden" name="remains" :value="json">
  </div>
</template>

<script>
  export default {
    name: 'ProductConfigRemains',
    props: {
      cities: {
        type: Array,
        required: true,
      },
      syncItems: {
        type: Array,
        required: true,
      },
    },
    data () {
      return {
        items: [],
        packing: [],
        tastes: [],
      }
    },
    mounted () {
      this.setupData()

      window.EventBus.$on('packing-added', this.addPacking)
      window.EventBus.$on('packing-deleted', this.deletePacking)
      window.EventBus.$on('taste-added', this.addTaste)
      window.EventBus.$on('taste-deleted', this.deleteTaste)
    },
    computed: {
      json () {
        let jsonData = this.items.map((el) => {
          return {
            city_id: el.city.id,
            packing_id: el.packing.id,
            taste_id: el.taste.id,
            quantity: parseInt(el.quantity),
          }
        })

        return JSON.stringify(jsonData)
      },
    },
    methods: {
      setupData () {
        if (!this.syncItems) {
          return
        }

        this.syncItems.forEach((el) => {
          if (!this.packing.some((packing) => packing.id === el.packing.id)) {
            this.packing.push(el.packing)
          }

          if (!this.tastes.some((taste) => taste.id === el.taste.id)) {
            this.tastes.push(el.taste)
          }
        })

        this.items = this.syncItems
      },
      filterRemains (cityId) {
        return this.items.filter((el) => el.city.id === cityId)
      },
      generateItems () {
        this.cities.forEach((city) => {
          this.packing.forEach((packing) => {
            this.tastes.forEach((taste) => {
              this.items.push({
                city: city,
                packing: packing,
                taste: taste,
                quantity: '',
              })
            })
          })
        })
      },
      addPacking (packing) {
        this.packing.push(packing)

        if (this.tastes.length > 0) {
          if (this.items.length === 0) {
            this.generateItems()
          } else {
            this.cities.forEach((city) => {
              this.tastes.forEach((taste) => {
                this.items.push({
                  city: city,
                  packing: packing,
                  taste: taste,
                  quantity: '',
                })
              })
            })
          }
        }
      },
      deletePacking (packing) {
        this.items = this.items.filter((el) => el.packing.id !== packing.id)
        this.packing = this.packing.filter((el) => el.id !== packing.id)
      },
      addTaste (taste) {
        this.tastes.push(taste)

        if (this.packing.length > 0) {
          if (this.items.length === 0) {
            this.generateItems()
          } else {
            this.cities.forEach((city) => {
              this.packing.forEach((packing) => {
                this.items.push({
                  city: city,
                  packing: packing,
                  taste: taste,
                  quantity: '',
                })
              })
            })
          }
        }
      },
      deleteTaste (taste) {
        this.items = this.items.filter((el) => el.taste.id !== taste.id)
        this.tastes = this.tastes.filter((el) => el.id !== taste.id)
      },
    },
  }
</script>
