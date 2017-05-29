<style scoped>
  img {
    display: block;
  }

  .notification-pane {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .notification-pane > div {
    text-align: center;
  }
</style>

<template>
  <div class="notification-pane">
    <div v-for="notification in notifications">
      <span>{{notification.user}} starred</span>
      <img :src="notification.url" />
    </div>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        notifications: []
      }
    },
    mounted() {
      window.Echo.channel('everyone')
        .listen('StarEvent', ({url, user, ...rest}) => {
            this.notifications.push({url, user})
        });
    }
  }
</script>
