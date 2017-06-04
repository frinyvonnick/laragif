<style scoped>
  .application {
    padding-bottom: 15px;
  }
</style>

<template>
  <div class="application container">
    <gif-grid @loadMore="onLoadMore" :loading="loading" :gifs="gifs"></gif-grid>
  </div>
</template>

<script>
import GifGrid from './GifGrid.vue'
import Spinner from './Spinner.vue'
import store from '../store.js'
import SearchBar from './SearchBar.vue'

export default {
  components: { GifGrid, Spinner, SearchBar },
  props: {
    initialGifs: {
      type: Array,
      default: () => [],
    },
    initialEndpoint: {
      type: String,
      default: '/api/trending/'
    }
  },
  data() {
    return {
      loading: false,
      offset: 0,
      gifs: this.initialGifs,
      endpoint: this.initialEndpoint,
    }
  },
  methods: {
    async fetch(url) {
      this.loading = true
      const response = await axios.get(url)
      this.loading = false
      this.gifs = [...this.gifs, ...response.data]
    },
    onLoadMore() {
      this.offset += 1
      this.fetch(`${this.endpoint}${this.offset}`)
    },
    onSearch(searchValue) {
      if (!window.location.href.includes('search')) {
        return window.location.href = `/search/${searchValue}`
      }
      this.offset = 0
      const endpointParts = this.endpoint.split('/')
      endpointParts[endpointParts.length - 2] = searchValue
      this.endpoint = endpointParts.join('/')

      this.fetch(`${this.endpoint}${this.offset}`)
    },
  },
}
</script>
