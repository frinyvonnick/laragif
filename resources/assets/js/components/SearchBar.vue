<template>
  <form>
    <div class="form-group">
      <input class="form-control" type="text" name="search" placeholder="Search" v-model="search"/>
    </div>
  </form>
</template>

<script>
import debounce from 'lodash/debounce'

export default {
  data() {
    return {
      search: ''
    }
  },
  watch: {
    search: debounce(function startSearch(newValue) {
      this.$emit('search', newValue)
    }, 500),
  }
}
</script>
