<template>
  <v-app id="dark-template">
    <v-fade-transition
      mode="out-in"
      type="animation"
    >
      <v-content>
        <v-container
          fluid
          fill-height
        >
          <v-layout
            align-center
            justify-center
          >
            <v-flex
              md10
              sm12
            >
              <v-layout wrap>
                <v-flex
                  md4
                >
                  <sidebar-container
                    :prop-resume-sections="resumeSections"
                    class="fill-height"
                  />
                </v-flex>
                <v-flex
                  md8
                >
                  <content-container
                    :prop-resume-sections="resumeSections"
                    class="fill-height"
                  />
                </v-flex>
              </v-layout>
              <v-layout>
                <v-flex md12>
                  <timeline-primary />
                  <timeline-endless />
                </v-flex>
              </v-layout>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
    </v-fade-transition>
  </v-app>
</template>

<script>
import SidebarContainer from '@/views/dark-template/sidebar/Container'
import ContentContainer from '@/views/dark-template/content/Container'
import TimelinePrimary from '@/views/dark-template/timeline/Primary'

export default {
  name      : 'DarkTemplateContainer',
  components: {
    TimelinePrimary,
    ContentContainer,
    SidebarContainer,
  },
  data () {
    return { resumeSections: { } }
  },
  mounted () {
    this.fetchSectionsData()
  },
  methods: {
    fetchSectionsData () {
      this.axios.get('/api/data.php')
        .then((response) => {
          if (response.data.sections)
            this.resumeSections = response.data
        })
      // eslint-disable-next-line unicorn/catch-error-name
        .catch((e) => {
          console.log(e)
        })
    },
  },
}
</script>

<style scoped>
#dark-template {
  height: 100%;
  background: #66668d;
  background: -webkit-linear-gradient(to left, #66668d, #4389a2);
  background: linear-gradient(to left, #66668d, #4389a2);
  background-size: cover;
}
</style>
