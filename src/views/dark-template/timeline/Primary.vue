<template>
  <v-card
    color="grey lighten-4"
    light
  >
    <v-card-title>
      <h3 class="title font-weight-light mb-1">
        My life
      </h3>
      <v-spacer />
    </v-card-title>
    <v-card-text>
      <v-timeline
        align-top
        :dense="$vuetify.breakpoint.smAndDown"
      >
        <v-timeline-item
          v-for="(item, i) in list"
          :key="i"
          :color="item.color"
          small
        >
          <template v-slot:opposite>
            <span
              v-text="item.year"
            />
          </template>
          <v-card>
            <v-card-title
              :class="`${item.color}--text headline`"
              v-html="item.title"
            />
            <v-card-text class="white text--primary">
              <p v-html="item.text" />
            </v-card-text>
          </v-card>
        </v-timeline-item>
      </v-timeline>
      <v-timeline
        align-top
        dense
      />
      <div pa-3>
        <infinite-loading @infinite="infiniteHandler" />
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name : 'Timeline',
  props: { propLife: { type: Object, default: () => {} } },
  data : () => ({
    detailed: true,
    page    : 1,
    list    : [],
  }),
  methods: {
    infiniteHandler ($state) {
      this.axios.get('/api/life.php', { params: { page: this.page } }).then(({ data }) => {
        // eslint-disable-next-line unicorn/explicit-length-check
        if (data.items.length) {
          this.page += 1
          this.list.push(...data.items)
          $state.loaded()
        } else
          $state.complete()
      })
    },
  },
}
</script>

<style scoped>

</style>
