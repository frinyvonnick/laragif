<template>
  <div>
    <img v-for="gif in gifs" v-bind:src="gif.url" />
  </div>
</template>

<script>
  export default {
    props: {
      gifs: {
        type: Array,
        default: []
      }
    },
  }
</script>
