<template>
  <div class="text-md-center">
    <v-avatar
      color="grey lighten-4"
      size="120"
    >
      <!--      TODO get user data from the server if there are none, specify the default -->
      <img
        :src="publicPath('/img/avatar-default.png')"
        alt="Default User Name"
      >
    </v-avatar>
  </div>
</template>

<script>
export default { name: 'Avatar' }
</script>

<style scoped>

</style>
