<template>
  <div>
    <search-bar @search="search"></search-bar>
    <search-result :gifs="currentGifs"></search-result>
    <spinner v-if="loading"></spinner>
    <button @click="loadMore">Afficher plus</button>
  </div>
</template>

<script>
import SearchResult from './SearchResult.vue'
import SearchBar from './SearchBar.vue'
import Spinner from './Spinner.vue'

export default {
  components: { SearchResult, SearchBar, Spinner },
  props: {
    gifs: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      currentOffset: 0,
      currentEndPoint: `/api/trending/`,
      currentGifs: this.gifs,
      loading: false,
    }
  },
  methods: {
    fetch() {
      return axios.get(`${this.currentEndPoint}${this.currentOffset}`)
    },
    async search(searchTerm) {
      this.currentOffset = 0
      this.currentEndPoint = `/api/search/${searchTerm}/`
      this.currentGifs = null
      const response = await this.fetch()
      this.currentGifs = response.data
    },
    async loadMore() {
      this.currentOffset++
      this.loading = true
      const response = await this.fetch()
      this.loading = false
      this.currentGifs = [...this.currentGifs, ...response.data]
    }
  },
}
</script>
