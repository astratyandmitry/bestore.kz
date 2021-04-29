<template>
  <div class="section">
    <div class="section__heading">
      <div class="section__title">
        Фасовки
      </div>

      <button @click="addEmptyItem" :disabled="entireDictionaryUsed"
              type="button" class="btn btn--outlined btn--primary btn--sm">
        Добавить
      </button>
    </div>

    <div v-if="items.length > 0">
      <div class="packing-grid field" v-for="itemIndex in items.keys()">
        <select v-if="!items[itemIndex].packing_id" required @change="addItem(itemIndex, $event)">
          <option value="">...</option>
          <option v-for="packing in availablePacking" :value="packing.id" v-text="packing.name"></option>
        </select>
        <input v-else type="text" disabled :value="getName(items[itemIndex].packing_id)">

        <input type="number" v-model="items[itemIndex].price" required placeholder="Цена">

        <input type="number" v-model="items[itemIndex].price_sale" placeholder="Со скидкой">

        <button @click="deleteItem(itemIndex)" type="button" class="btn btn--danger btn--outlined">
          <i class="fas fa-trash"></i>
        </button>
      </div>

      <input type="hidden" name="packing" :value="json">
    </div>

    <div class="empty-message" v-else>
      Добавьте фасовку для того, чтобы указать остатки
    </div>
  </div>
</template>

<script>
  export default {
    name: 'ProductConfigPacking',
    props: {
      packing: {
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
        items: []
      }
    },
    mounted() {
      this.items = this.syncItems
    },
    computed: {
      entireDictionaryUsed () {
        return this.packing.length === this.items.length
      },
      availablePacking () {
        const packingId = this.items.map((el) => el.packing_id)

        return this.packing.filter((el) => !packingId.includes(el.id))
      },
      json () {
        let jsonData = this.items
          .filter((el) => el.packing_id > 0)
          .map((el) => {
            return {
              packing_id: el.packing_id,
              price: parseInt(el.price),
              price_sale: parseInt(el.price_sale),
            }
          })

        return JSON.stringify(jsonData)
      },
    },
    methods: {
      addEmptyItem () {
        this.items.push({
          packing_id: null,
          price: '',
          priceSale: '',
        })
      },
      addItem (index, event) {
        const packingId = parseInt(event.target.value)

        this.items[index].packing_id = packingId

        window.EventBus.$emit('packing-added', this.find(packingId))
      },
      deleteItem (index) {
        const item = this.items[index]

        this.items.splice(index, 1)

        window.EventBus.$emit('packing-deleted', this.find(item.packing_id))
      },
      find (packingId) {
        const packing = this.packing.filter((el) => el.id === packingId)

        return packing.length ? packing[0] : {}
      },
      getName (packingId) {
        return this.find(packingId).name
      },
    },
  }
</script>

