<style scoped>
  .gif-container {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding-bottom: 15px;
    position: relative;
  }
</style>

<template>
  <div class="gif-container">
    <img :src="src" />
    <span v-if="title">{{title}}</span>
  </div>
</template>

<script>
import store from '../store.js'
import pick from 'lodash/pick'

export default {
  props: {
    src: {
      type: String,
      default: '',
    },
  },
}
</script>
