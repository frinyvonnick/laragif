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
      search: 'foo',
      maxRating: null,
    }
  },
  watch: {
    search: debounce((newValue) => {
      if (newValue !== '') {
        axios.get(`/api/search/${newValue}/0`)
          .then(response => console.log(response))
      }
    }, 500),
  },
}
</script>
