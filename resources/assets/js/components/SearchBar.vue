<template>
  <form>
    <label for="search">Search</label>
    <input type="text" name="search" v-model="search" />
  </form>
</template>

<script>
import debounce from 'lodash/debounce'

export default {
  data() {
    return {
      search: '',
    }
  },
  watch: {
    search: debounce(function startSearch(newValue) {
      if (newValue !== '') {
        this.$emit('search', newValue)
      }
    }, 500),
  },
}
</script>
