<template>
  <section class="block block--offset">
    <product-config-packing :sync-items="packing" :packing="dictionaryPacking"></product-config-packing>

    <product-config-taste :sync-items="tastes" :tastes="dictionaryTaste"></product-config-taste>

    <product-config-remains :sync-items="remains" :cities="dictionaryCity"></product-config-remains>
  </section>
</template>

<script>
  import ProductConfigPacking from './ProductConfigPacking'
  import ProductConfigTaste from './ProductConfigTaste'
  import ProductConfigRemains from './ProductConfigRemains'

  export default {
    name: 'ProductConfig',
    components: { ProductConfigRemains, ProductConfigTaste, ProductConfigPacking },
    props: {
      dictionaryPacking: {
        type: Array,
        required: true,
      },
      dictionaryTaste: {
        type: Array,
        required: true,
      },
      dictionaryCity: {
        type: Array,
        required: true,
      },
      packing: {
        type: Array,
        default: () => []
      },
      tastes: {
        type: Array,
        default: () => []
      },
      remains: {
        type: Array,
        default: () => []
      },
    },
  }
</script>

<style lang="scss">
  .empty-message {
    background: #fafafa;
    text-align: center;
    padding: 1rem;
    border-radius: 4px;
    color: #777;
    font-size: 14px;
    margin-bottom: 2rem;
  }

  .packing-grid {
    display: flex;

    select {
      margin-right: 8px;
      flex-grow: 1;
      width: 100%;
    }

    input {
      margin-right: 8px;

      &:last-child {
        margin-right: 0;
      }
    }

    input[type=number] {
      width: 132px !important;
    }

    button i {
      margin: 0;
    }
  }
</style>
