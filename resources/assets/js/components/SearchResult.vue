<template>
  <div v-if="loaded">
    <gif v-for="gif in gifs" :key="gif.id" :src="gif.url" @click="toggle(gif.id)" :starred="gif.starred"></gif>
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
import Gif from './Gif.vue'

export default {
  components: { Spinner, Gif },
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
  methods: {
    toggle(id) {
      this.$emit('toggle', id)
    },
  },
}
</script>
