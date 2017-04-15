<template>
  <div>
    <img class="gif" v-for="gif in gifs" :src="gif.images.fixed_width.url" />
  </div>
</template>

<style scoped>
.gif {
  padding: 8px;
}
</style>

<script>
  export default {
    props: {
      gifs: {
        type: Array,
        default: [],
      },
    },
  }
</script>
