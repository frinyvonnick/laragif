<template>
  <!-- <div>
    <img class="gif" v-for="gif in gifs" :src="gif.url" />
  </div> -->
  <div>
    <search-bar></search-bar>
    <search-result :gifs="currentGifs"></search-result>
  </div>
</template>

<style scoped>
.gif {
  padding: 8px;
}
</style>

<script>
import SearchResult from './SearchResult.vue'
import SearchBar from './SearchBar.vue'

export default {
  components: { SearchResult, SearchBar },
  props: {
    gifs: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      currentGifs: this.gifs,
    }
  },
}
</script>
