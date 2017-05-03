<template>
  <div @click="$emit('click')">
    <span>{{starred}}</span>
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
    }
  },
}
</script>
