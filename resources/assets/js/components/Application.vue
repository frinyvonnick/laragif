<template>
  <div>
    <img class="gif" v-for="gif in gifs" :src="gif.url" />
  </div>
</template>

<style scoped>
.gif {
  padding: 8px;
}
</style>

<script>
  export default {
    beforeCreate() {
      axios
        .get('/')
        .then((response) => {
          this.gifs = response.data
        })
    },
    data() {
      return {
        gifs: null,
      }
    },
  }
</script>
