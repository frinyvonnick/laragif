<template>
  <div v-if="loaded">
    <img class="gif" v-for="gif in gifs" :src="gif.url" />
  </div>
  <spinner v-else></spinner>
</template>

<style scoped>
.gif {
  padding: 8px;
}
</style>

<script>
import Spinner from './Spinner.vue'

export default {
  components: { Spinner },
  props: {
    gifs: {
      type: Array,
      default: [],
    },
  },
  computed: {
    loaded() {
      return this.gifs !== null
    },
  },
}
</script>
