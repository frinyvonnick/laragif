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
  .load-more {
    width: 100%;
    padding: 10px 15px;
    border-radius: 0;
    font-size: 1.2em;
    outline: 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .load-more span {
    margin-left: 15px;
  }

  .load-more svg {
    width: 42px;
    height: 42px;
  }

  .load-more:disabled {
    padding: 0;
    margin: 0;
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
            :starred="gif.starred"
            :starVisible="connected"
            @toggle="toggleStar(gif.id)"
          >
          </gif>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <button class="btn btn-default load-more" :disabled="loading" @click="loadMore">
          <spinner v-if="loading"></spinner>
          <span v-else >Afficher plus de gifs</span>
        </button>
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
    loading: {
      type: Boolean,
      default: false,
    },
    connected: {
      type: Boolean,
      default: false,
    }
  },
  computed: {
    columns() {
      return chunk(this.gifs, Math.floor(this.gifs.length / 4) || 1)
    },
  },
  methods: {
    loadMore() {
      this.$emit('loadMore')
    },
    toggleStar(id) {
      const newStar = !this.gifs.find(g => g.id === id).starred
      this.$emit('starChange', {id, starred: newStar})
      axios.put(`/api/star/${id}`)
        .then((response) => {
          this.$emit('starChange', {id, starred: response.data.starred})
        })
    }
  },
}
</script>
