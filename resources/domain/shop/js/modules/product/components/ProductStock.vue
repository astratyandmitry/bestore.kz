<template>
  <div class="stock">
    <div class="form-select">
      <label for="packing" class="form-label">Фасовка</label>

      <select id="packing" v-model="packingId" class="form-input">
        <option v-for="packing in packings" :value="packing.id">
          {{ packing.name }}
        </option>
      </select>
    </div>

    <div class="form-select">
      <label for="taste" class="form-label">Вкус</label>
      <select id="taste" v-model="tasteId" class="form-input">
        <option v-for="taste in packing.tastes" :value="taste.id">
          {{ taste.name }}
        </option>
      </select>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'ProductStock',
    props: {
      packings: {
        type: Array,
        required: true,
      },
    },
    created () {
      this.packingId = this.packings[0].id
    },
    data () {
      return {
        packingId: '',
        tasteId: '',
      }
    },
    computed: {
      packing () {
        return this.packings.find((s) => s.id === parseInt(this.packingId))
      },
      taste () {
        return this.packing.tastes?.find((t) => t.id === parseInt(this.tasteId))
      },
    },
    watch: {
      packingId () {
        if (!this.taste) {
          this.tasteId = this.packing.tastes[0].id
        }

        this.fireEvent()
      },
      tasteId () {
        this.fireEvent()
      },
    },
    methods: {
      fireEvent () {
        window.eventBus.$emit('config-updated', {
          price: this.packing.price,
          price_sale: this.packing.price_sale,
          quantity: this.taste.quantity,
          basket: this.taste.basket,
          stock: {
            product_id: this.$parent.productId,
            packing_id: this.packingId,
            taste_id: this.tasteId,
          }
        })
      }
    }
  }
</script>
