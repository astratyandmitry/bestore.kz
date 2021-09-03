<template>
  <div class="section">
    <div class="section__heading">
      <div class="section__title">
        Вкусы
      </div>

      <button @click="addEmptyItem" :disabled="entireDictionaryUsed"
              type="button" class="btn btn--outlined btn--primary btn--sm">
        Добавить
      </button>
    </div>

    <div v-if="items.length > 0">
      <div class="packing-grid field" v-for="itemIndex in items.keys()">
        <select v-if="!items[itemIndex].taste_id" required @change="addItem(itemIndex, $event)">
          <option value="" disabled selected>...</option>
          <option v-for="taste in availableTastes" :value="taste.id" v-text="taste.name"></option>
        </select>
        <input v-else type="text" disabled :value="getName(items[itemIndex].taste_id)">

        <button @click="deleteItem(itemIndex)" type="button" class="btn btn--danger btn--outlined">
          <i class="fas fa-trash"></i>
        </button>
      </div>

      <input type="hidden" name="tastes" :value="json">
    </div>

    <div class="empty-message" v-else>
      Добавьте вкус для того, чтобы указать остатки
    </div>
  </div>
</template>

<script>
  export default {
    name: 'ProductConfigTaste',
    props: {
      tastes: {
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
    mounted () {
      this.items = this.syncItems
    },
    computed: {
      entireDictionaryUsed () {
        return this.tastes.length === this.items.length
      },
      availableTastes () {
        const tastesId = this.items.map((el) => el.taste_id)

        return this.tastes.filter((el) => !tastesId.includes(el.id))
      },
      json () {
        let jsonData = this.items.filter((el) => el.taste_id > 0)

        return JSON.stringify(jsonData)
      },
    },
    methods: {
      addEmptyItem () {
        this.items.push({
          taste_id: null,
        })
      },
      addItem (index, event) {
        const tasteId = parseInt(event.target.value)

        this.items[index].taste_id = tasteId

        window.EventBus.$emit('taste-added', this.find(tasteId))
      },
      deleteItem (index) {
        const item = this.items[index]

        this.items.splice(index, 1)

        window.EventBus.$emit('taste-deleted', this.find(item.taste_id))
      },
      find (tasteId) {
        const taste = this.tastes.filter((el) => el.id === tasteId)

        return taste.length ? taste[0] : {}
      },
      getName (tasteId) {
        return this.find(tasteId).name
      },
    },
  }
</script>
