<template>
  <v-card
    v-if="propResumeSections.sections && propResumeSections.user"
    color="grey darken-3"
    dark
  >
    <v-card-text>
      <avatar
        :options="propResumeSections.user"
      />
      <div
        v-if="propResumeSections.user"
        class="text-sm-center mb-4 mt-3"
      >
        <h1>
          {{ propResumeSections.user.name }} {{ propResumeSections.user.secondName }} <span class="light-blue--text text--lighten-3">{{ propResumeSections.user.lastName }}</span>
        </h1>
        <span>
          {{ propResumeSections.user.personalProfession }}
        </span>
      </div>

      <sidebar-section
        :options="propResumeSections.sections.info"
      />
      <sidebar-section
        :options="propResumeSections.sections.socials"
      />
      <sidebar-section
        :options="propResumeSections.sections.hobbies"
      >
        <template v-slot:item="{item}">
          <v-chip>
            <v-avatar>
              <v-icon>
                {{ item.icon }}
              </v-icon>
            </v-avatar>
            {{ item.text }}
          </v-chip>
        </template>
      </sidebar-section>
      <sidebar-section
        :options="propResumeSections.sections.languages"
      >
        <template v-slot:items="{items}">
          <v-container pa-0>
            <v-layout
              wrap
              class="text-xs-center"
            >
              <template
                v-for="(item, i) in items"
              >
                <v-flex
                  :key="i"
                  md3
                  sm4
                  xs6
                >
                  <v-progress-circular
                    rotate="360"
                    size="65"
                    width="2"
                    :value="item.text"
                    color="white"
                    class="ma-2"
                  >
                    {{ item.name }}
                  </v-progress-circular>
                </v-flex>
              </template>
            </v-layout>
          </v-container>
        </template>
      </sidebar-section>
    </v-card-text>
  </v-card>
</template>

<script>
import Avatar from '@/views/dark-template/sidebar/Avatar'
import SidebarSection from '@/views/dark-template/sidebar/Section'
export default {
  name      : 'Sidebar',
  components: { SidebarSection, Avatar },
  props     : { propResumeSections: { type: Object, default: () => {} } },
}
</script>

<style scoped>
.sidebar{
    background: #2e2e2e;
}
</style>
