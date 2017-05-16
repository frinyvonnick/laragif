<template>
  <form class="navbar-form">
    <div class="form-group">
      <input class="form-control" type="text" name="search" v-model="search" placeholder="Search" />
    </div>
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
  data() {
    return {
      sharedState: store.state,
      search: this.initialSearch
    }
  },
  watch: {
    search: debounce(async function startSearch(newValue) {
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
