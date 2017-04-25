<template>
  <button v-on:click="loadMore">Afficher plus</button>
</template>

<script>
export default {
  methods: {
    loadMore: function () {
      this.$emit('loadMore')
    }
  }
}
</script>
