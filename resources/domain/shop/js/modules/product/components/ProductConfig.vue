<template>
  <div class="product__config" id="product">
    <product-stock :packings="stocks"/>

    <product-basket :stock="stock"/>
  </div>
</template>

<script>
  import ProductStock from './ProductStock'
  import ProductBasket from './ProductBasket'

  export default {
    name: 'ProductConfig',
    components: { ProductBasket, ProductStock },
    props: {
      stocks: {
        type: Array,
        required: true,
      },
      productId: {
        type: Number,
        required: true,
      },
    },
    data () {
      return {
        stock: {
          product_id: null,
          packing_id: null,
          taste_id: null,
        }
      }
    },
  }
</script>
