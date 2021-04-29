<template>
  <div class="product__config__grid">
    <div class="price">
      <div class="price__prev" v-if="price_sale">
        <span v-text="price_sale"></span> ₸
      </div>

      <div class="price__value">
        <span v-text="price"></span> ₸
      </div>

      <div class="price__notice">
        Цена актуальна только в <span class="nowrap">интернет-магазине</span>
      </div>
    </div>

    <div class="basket">
      <div class="basket__count">
        <div class="basket__count__button" :class="{ 'basket__count__button--disabled': reachMin }" @click="decrease">
          <span>-</span>
        </div>

        <div class="basket__count__value">
          <span v-text="count"></span>
        </div>

        <div class="basket__count__button" :class="{ 'basket__count__button--disabled': reachMax }" @click="increase">
          <span>+</span>
        </div>
      </div>

      <button class="basket__button" :class="{ 'basket__button--active' : inBasket }" @click="handle">
        <span class="basket__button__content">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="basket__button__icon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
          <span>{{ inBasket ? 'В корзине' : 'В корзину' }}</span>
        </span>
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ProductBasket',
  created () {
    window.eventBus.$on('config-updated', (config) => {
      this.stock = config.stock
      this.price = config.price
      this.price_sale = config.price_sale
      this.max = config.quantity

      if (!this.added.hasOwnProperty(this.stockKey)) {
        this.$set(this.added, this.stockKey, config.basket)
      }

      if (this.count > this.max) {
        this.count = this.max
      }
    })
  },
  data () {
    return {
      price: 0,
      price_sale: 0,
      count: 1,
      max: 1,
      added: {},
      stock: null,
    }
  },
  computed: {
    reachMin () {
      return this.count === 1
    },
    reachMax () {
      return this.count >= this.max
    },
    stockKey () {
      if (!this.stock) {
        return
      }

      return `${this.stock.product_id}.${this.stock.packing_id}.${this.stock.taste_id}`
    },
    inBasket () {
      return this.added.hasOwnProperty(this.stockKey) && this.added[this.stockKey] > 0
    }
  },
  methods: {
    decrease () {
      if (this.reachMin) {
        return
      }

      if (this.inBasket) {
        return this.request('/basket/decrease')
      }

      return this.count--
    },
    increase () {
      if (this.reachMax) {
        return
      }

      if (this.inBasket) {
        return this.request('/basket/increase')
      }

      return this.count++
    },
    request (endpoint) {
      axios.post(endpoint, this.stock)
        .then(({ data }) => {
          this.$set(this.added, this.stockKey, this.count = data.count)
        })
    },
    handle () {
      if (this.inBasket) {
        return window.location.href = '/basket'
      }

      this.request(`/basket?quantity=${this.count}`)
    }
  }
}
</script>
