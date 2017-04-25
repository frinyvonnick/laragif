<template>
  <div>
    <search-bar v-on:search="search"></search-bar>
    <search-result :gifs="currentGifs"></search-result>
    <spinner v-if="loading"></spinner>
    <load-more-button v-on:loadMore="onLoadMore"></load-more-button>
  </div>
</template>

<script>
import SearchResult from './SearchResult.vue'
import SearchBar from './SearchBar.vue'
import LoadMoreButton from './LoadMoreButton.vue'
import Spinner from './Spinner.vue'

export default {
  components: { SearchResult, SearchBar, LoadMoreButton, Spinner },
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
    search(searchTerm) {
      this.currentEndPoint = `/api/search/${searchTerm}/`
      this.currentGifs = null
      this.fetch()
        .then((response) => {
          this.currentGifs = response.data
        })
    },
    onLoadMore() {
      this.currentOffset++
      this.loading = true
      this.fetch()
        .then((response) => {
          this.loading = false
          this.currentGifs = [...this.currentGifs, ...response.data]
        })
    }
  },
}
</script>
