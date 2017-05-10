<style scoped>
  .gif-container {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }

  .star {
    align-self: center;
  }
</style>

<template>
  <div class="gif-container" @click="$emit('click')">
    <span v-if="starEnabled" class="star">{{starred}}</span>
    <img :src="src" />
  </div>
</template>

<script>
export default {
  props: {
    src: {
      type: String,
      default: '',
    },
    starred: {
      type: Boolean,
      default: false,
    },
    starEnabled: Boolean,
  },
}
</script>
