<template>
  <div>
    <gifs @loadMore="onLoadMore" :loading="loading" :gifs="sharedState.gifs"></gifs>
    <spinner v-if="loading"></spinner>
  </div>
</template>

<script>
import Gifs from './Gifs.vue'
import Spinner from './Spinner.vue'
import store from '../store.js'

export default {
  components: { Gifs, Spinner },
  props: {
    gifs: {
      type: Array,
      default: [],
    },
    authenticatedUser: {
      type: Object,
      default: () => ({}),
    },
    endpoint: {
      type: String,
      required: true,
    }
  },
  data() {
    return {
      sharedState: store.state,
      loading: false,
    }
  },
  beforeCreate() {
    store.set('gifs', this.$options.propsData.gifs)
    store.set('endpoint', this.$options.propsData.endpoint)
    store.set('user', this.$options.propsData.authenticatedUser)
  },
  methods: {
    fetch() {
      return axios.get(`${this.sharedState.endpoint}${this.sharedState.offset}`)
    },
    async onLoadMore() {
      store.set('offset', this.sharedState.offset + 1)
      this.loading = true
      const response = await this.fetch()
      this.loading = false
      store.set('gifs', [...this.sharedState.gifs, ...response.data])
    }
  },
}
</script>
