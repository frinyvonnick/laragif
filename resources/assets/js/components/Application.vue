<template>
  <div>
    <search-bar @search="search"></search-bar>
    <search-result @toggle="toggleStar" :gifs="currentGifs"></search-result>
    <spinner v-if="loading"></spinner>
    <button :disabled="loading" @click="loadMore">Afficher plus</button>
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
    authenticatedUser: {
      type: Object,
      default: () => ({}),
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
    toggleStar(id) {
      axios.get(`/api/star/${id}`)
        .then((response) => {
          this.currentGifs.find(gif => gif.id === id).starred = response.data.starred
        })
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
