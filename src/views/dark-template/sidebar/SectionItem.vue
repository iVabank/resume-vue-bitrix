<template>
  <v-layout>
    <v-flex
      v-if="hasIcon"
      xs2
    >
      <v-icon>
        {{ item.icon }}
      </v-icon>
    </v-flex>
    <v-flex
      :xs10="hasIcon"
      :xs12="!hasIcon"
    >
      <div>
        {{ item.name }}
      </div>
      <p>
        <template v-if="item.link">
          <template v-if="item.name == 'Email'">
            <a
              class="grey--text"
              :href="'mailto:'+item.link"
            >
              {{ item.text }}
            </a>
          </template>
          <template v-else>
            <a
              class="grey--text"
              :href="item.link"
              target="_blank"
            >
              {{ item.text }}
            </a>
          </template>
        </template>
        <template v-else>
          <span class="grey--text">
            {{ item.text }}
          </span>
        </template>
      </p>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name    : 'SidebarSectionItem',
  props   : { item: { type: Object, default: () => {} } },
  computed: {
    hasIcon () {
      return !!this.item.icon
    },
  },
}
</script>

<style scoped>
</style>
