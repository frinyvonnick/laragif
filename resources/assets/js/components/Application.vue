<style scoped>
  .application {
    padding-bottom: 15px;
    display: flex;
  }
  .main-content {
    width: 60%;
  }
  .sidebar {
    width: 40%;
  }
</style>

<template>
  <div class="application container">
    <search-bar @search="onSearch"></search-bar>
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
      required: true,
    }
  },
  data() {
    return {
      loading: false,
      offset: 0,
      gifs: this.initialGifs,
      endpoint: this.initialEndpoint,
      notifications: [],
      initialSearch: window.location.href.split('search/')[1] || ''
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
      window.history.pushState({}, '', `/search/${searchValue}`)
      this.endpoint = `/api/search/${searchValue}/`
      this.offset = 0
      this.gifs = []
      this.fetch(`${this.endpoint}${this.offset}`)
    },
  },
}
</script>
