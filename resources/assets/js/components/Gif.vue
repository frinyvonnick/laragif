<style scoped>
  .gif-container {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding-bottom: 15px;
    position: relative;
  }

  .star {
    align-self: center;
  }
</style>

<template>
  <div class="gif-container" @click="$emit('toggle')">
    <star v-if="starVisible" :enabled="starred" ></star>
    <img :src="src" />
    <span v-if="title">{{title}}</span>
  </div>
</template>

<script>
import store from '../store.js'
import Star from './Star.vue'
import pick from 'lodash/pick'

export default {
  components: { Star },
  props: {
    src: {
      type: String,
      default: '',
    },
    starred: {
      type: Boolean,
      default: false,
    },
    starVisible: {
      type: Boolean,
      default: false,
    },
    title: {
      type: String,
      default: '',
    }
  },
}
</script>
