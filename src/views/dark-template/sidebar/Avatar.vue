<template>
  <div class="text-md-center">
    <v-avatar
      color="grey lighten-4"
      size="120"
    >
      <img
        :src="options.pathPersonalPhoto"
        :alt="options.name+' '+options.secondName+' '+options.lastName"
        :title="options.name+' '+options.secondName+' '+options.lastName"
      >
    </v-avatar>
  </div>
</template>

<script>
export default {
  name : 'Avatar',
  props: { options: { type: Object, default: () => {} } },
}
</script>

<style scoped>

</style>
