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
    <div class="main-content">
      <search-bar @search="onSearch"></search-bar>
      <gif-grid @loadMore="onLoadMore" :loading="loading" :gifs="gifs" :connected="connected" @starChange="updateGif"></gif-grid>
    </div>
    <div class="sidebar">
      <gif-grid :more="false" :gifs="notifications" :connected="connected" @starChange="updateGif" :columnCount="1"></gif-grid>
    </div>
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
      notifications: [],
    }
  },
  computed: {
    connected() {
      return !!this.authenticatedUser.id
    }
  },
  mounted() {
    window.Echo.channel('everyone')
      .listen('StarEvent', ({url, user, id}) => {
        const gif = {url, title: `starred by ${user}`, id}
        if(this.connected) {
          axios.get(`/api/star/${id}`)
            .then(result => {
              this.notifications.push({...gif, starred: result.data.starred})
            })
        } else {
          this.notifications.push(gif)
        }
      });
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
      this.updateGifInArray(newGif, this.gifs)
      this.updateGifInArray(newGif, this.notifications)
    },
    updateGifInArray(newGif, array) {
      const index = array.findIndex(g => g.id === newGif.id)
      if(index > -1) {
        const gif = array[index]
        this.$set(array, index, {...gif, ...newGif})
      }
    }
  },
}
</script>
