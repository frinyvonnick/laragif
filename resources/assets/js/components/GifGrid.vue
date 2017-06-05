<style scoped>
  .masonry-layout {
    column-count: 4;
    column-gap: 0;
  }
  .masonry-layout__panel {
    break-inside: avoid;
  }
  .masonry-layout__panel-content {
    padding-left: 15px;
  }
  .masonry-layout__panel:first-child .masonry-layout__panel-content {
    padding-left: 0;
  }
</style>

<template>
  <div>
    <div class="masonry-layout">
      <div v-for="column in columns" class="masonry-layout__panel">
        <div class="masonry-layout__panel-content">
          <gif
            v-for="gif in column"
            :key="gif.id"
            :src="gif.url"
          >
          </gif>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Spinner from './Spinner.vue'
import Gif from './Gif.vue'
import chunk from 'lodash/chunk'

export default {
  components: { Spinner, Gif },
  props: {
    gifs: {
      type: Array,
      default: [],
    },
  },
  computed: {
    columns() {
      return chunk(this.gifs, Math.floor(this.gifs.length / 4) || 1)
    },
  },
}
</script>
