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
  <div class="gif-container" @click="toggleStar">
    <star v-if="isConnected" :enabled="starred" ></star>
    <img :src="src" />
  </div>
</template>

<script>
import store from '../store.js'
import Star from './Star.vue'
import pick from 'lodash/pick'

export default {
  components: { Star },
  props: {
    id: {
      type: String,
      required: true,
    },
    src: {
      type: String,
      default: '',
    },
    starred: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return pick(store.state, ['gifs', 'user'])
  },
  computed: {
    isConnected() {
      return !!this.user.id
    }
  },
  methods: {
    toggleStar() {
      if (this.isConnected) {
        axios.get(`/api/star/${this.id}`)
          .then((response) => {
            const index = this.gifs.findIndex(gif => gif.id === this.id)
            store.set(`gifs[${index}].starred`, response.data.starred)
          })
      }
    }
  }
}
</script>
