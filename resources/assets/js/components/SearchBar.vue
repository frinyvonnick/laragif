<template>
  <form>
    <div class="form-group">
      <input class="form-control" type="text" name="search" placeholder="Search" />
    </div>
  </form>
</template>

<script>
import debounce from 'lodash/debounce'
import pick from 'lodash/pick'

export default {
  props: {
    initialSearch: {
      type: String,
      default: '',
    }
  },
}
</script>
