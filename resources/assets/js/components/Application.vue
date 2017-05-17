<style scoped>
  .application {
    padding-bottom: 15px;
  }
</style>

<template>
  <div class="application container">
    <search-bar @search="onSearch"></search-bar>
    <gif-grid @loadMore="onLoadMore" :loading="loading" :gifs="gifs" :connected="connected" @starChange="updateGif"></gif-grid>
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
    authenticatedUser: {
      type: Object,
      default: () => ({}),
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
    }
  },
  computed: {
    connected() {
      return !!this.authenticatedUser.id
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
    updateGif(newGif) {
      const index = this.gifs.findIndex(g => g.id === newGif.id)
      if(index > -1) {
        const gif = this.gifs[index]
        this.$set(this.gifs, index, {...gif, ...newGif})
      }
    }
  },
}
</script>
