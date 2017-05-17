<template>
  <form>
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
    search: debounce(function startSearch(newValue) {
      this.$emit('search', newValue)
    }, 500),
  },
}
</script>
