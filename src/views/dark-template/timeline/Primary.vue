<template>
  <v-card
    v-if="propLife"
    color="grey lighten-4"
    light
  >
    <v-card-text>
      <v-card>
        <v-layout>
          <v-flex md6>
            <v-card-title
              class="headline"
              v-text="all ? 'My life all' : 'My life main'"
            />
          </v-flex>
          <v-flex
            md6
            class="align-end"
          >
            <v-switch
              v-model="all"
              label="all"
            />
          </v-flex>
        </v-layout>
      </v-card>
    </v-card-text>

    <v-card-text>
      <v-timeline
        :dense="$vuetify.breakpoint.smAndDown"
      >
        <v-timeline-item
          v-for="(item, i) in list"
          :key="i"
          :color="item.color"
          :icon="item.icon"
          big
        >
          <v-card>
            <v-card-title
              :class="`${item.color}--text headline`"
              class="mb-0 pb-0"
              v-html="item.title"
            />
            <v-card-text class="mt-0 pt-0">
              <p>
                <template v-if="item.date">
                  <small>
                    <i>{{ item.date }}</i>
                  </small>
                  <br>
                </template>
                <template v-if="item.link">
                  <small>
                    <template v-if="item.link">
                      <a
                        class="grey--text"
                        :href="item.link"
                        target="_blank"
                      >
                        {{ item.source }}
                      </a>
                    </template>
                    <template v-else>
                      <span class="grey--text">
                        {{ item.source }}
                      </span>
                    </template>
                  </small>
                </template>
              </p>

              <p v-html="item.text" />
              <template v-if="item.photos">
                <v-layout>
                  <v-flex md12>
                    <CoolLightBox
                      :items="gallerySelect"
                      :index="index"
                      @close="index = null"
                    />
                    <v-avatar
                      v-for="(photo, i) in item.photos"
                      :key="i"
                      rounded
                      class="ma-3"
                      size="125"
                      style="cursor: pointer;"
                      tile
                      @click="selectGallery(photo.gallery_key, i)"
                    >
                      <v-img :src="photo.thumb" />
                    </v-avatar>
                  </v-flex>
                </v-layout>
              </template>
            </v-card-text>
          </v-card>
        </v-timeline-item>
      </v-timeline>
    </v-card-text>

    <v-card-text>
      <div>
        <infinite-loading
          :identifier="infiniteId"
          @infinite="infiniteHandler"
        />
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name : 'Timeline',
  props: { propLife: { type: Boolean, default: false } },
  data : () => ({
    page         : 1,
    list         : [],
    all          : true,
    type         : 1,
    infiniteId   : +new Date(),
    index        : null,
    items        : [],
    gallerySelect: [],
  }),
  watch: {
    all (v) {
      if (v !== true)
        this.type = 0
      else
        this.type = 1
      this.page       = 1
      this.list       = []
      this.infiniteId += 1
    },
  },
  methods: {
    infiniteHandler ($state) {
      this.axios.get(`/api/life.php`, {
        params: {
          page: this.page,
          type: this.type,
        },
      }).then(({ data }) => {
        // eslint-disable-next-line unicorn/explicit-length-check
        if (data.items.length) {
          const pagePrev = this.page - 1
          this.page      += 1
          this.list.push(...data.items)
          this.items.push(pagePrev)
          for (let i = 0; i < this.items.length; i++) {
            if (this.items[i] === pagePrev)
              this.items[i] = this.list[pagePrev].photos
          }
          $state.loaded()
        } else
          $state.complete()
      })
    },
    selectGallery (gallery_key, photo_key) {
      this.index         = null
      this.gallerySelect = this.items[gallery_key]
      this.index         = photo_key
    },
  },
}
</script>

<style scoped>

</style>
