<template>
  <div>
    <div class="gifs-container" v-if="loaded">
      <gif v-for="gif in gifs" :key="gif.id" :id="gif.id" :src="gif.url" :starred="gif.starred"></gif>
    </div>
    <spinner v-else></spinner>
    <button :disabled="loading" @click="loadMore">Afficher plus</button>
  </div>
</template>

<style scoped>
.gif {
  padding: 8px;
}
.gifs-container {
  display: flex;
  flex-wrap: wrap;
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
    loading: {
      type: Boolean,
      default: false,
    }
  },
  computed: {
    loaded() {
      return this.gifs !== null
    },
  },
  methods: {
    loadMore() {
      this.$emit('loadMore')
    }
  },
}
</script>
