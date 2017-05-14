<template>
  <form>
    <label for="search">Search</label>
    <input type="text" name="search" v-model="sharedState.search" />
  </form>
</template>

<script>
import debounce from 'lodash/debounce'
import pick from 'lodash/pick'
import store from '../store.js'

export default {
  props: {
    initialSearch: {
      type: String,
      default: '',
    }
  },
  beforeCreate() {
    store.set('search', this.$options.propsData.initialSearch)
  },
  data() {
    return {
      sharedState: store.state
    }
  },
  watch: {
    ['sharedState.search']: debounce(async function startSearch(newValue) {
      if (!window.location.href.includes('search')) {
        return window.location.href = `/search/${newValue}`
      }
      if (newValue !== '') {
        store.set('search', newValue)
        store.set('offset', 0)

        const endpointParts = this.sharedState.endpoint.split('/')
        endpointParts[endpointParts.length - 2] = newValue
        store.set('endpoint', endpointParts.join('/'))

        const response = await axios.get(`${this.sharedState.endpoint}${this.sharedState.offset}`)
        store.set('gifs', response.data)
      }
    }, 500),
  },
}
</script>
