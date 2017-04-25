<template>
  <div>
    <search-bar @search="search"></search-bar>
    <search-result :gifs="currentGifs"></search-result>
  </div>
</template>

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
      loading: true,
    }
  },
  methods: {
    search(searchTerm) {
      this.currentGifs = null
      axios.get(`/api/search/${searchTerm}/0`)
        .then((response) => {
          this.currentGifs = response.data
        })
    },
  },
}
</script>
