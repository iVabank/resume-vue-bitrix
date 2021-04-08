<template>
  <v-card
    v-if="propResumeSections.about"
    color="grey lighten-4"
    light
  >
    <v-card-text>
      <template v-if="propResumeSections.about">
        <content-section
          v-for="(about, i) in propResumeSections.about"
          :key="i"
          :title="about.title"
        >
          <v-layout>
            <v-flex md12>
              <div
                v-if="about.text"
                v-html="about.text"
              />
            </v-flex>
          </v-layout>
        </content-section>
      </template>
      <content-section
        v-if="propResumeSections.products"
        :title="propResumeSections.products.title"
      >
        <v-layout
          v-for="(product, i) in propResumeSections.products.items"
          :key="i"
        >
          <v-flex
            md1
            xs3
          >
            <v-icon right>
              {{ product.icon }}
            </v-icon>
          </v-flex>
          <v-flex
            md11
            xs9
          >
            <p>
              <strong>{{ product.name }}</strong><br>
              <small v-html="product.text" /><br>
              <small>
                <template v-if="product.link">
                  <a
                    class="grey--text"
                    :href="product.link"
                    target="_blank"
                  >
                    {{ product.source }}
                  </a>
                </template>
                <template v-else>
                  <span class="grey--text">
                    {{ product.source }}
                  </span>
                </template>
              </small>
            </p>
          </v-flex>
        </v-layout>
      </content-section>
      <content-section
        v-if="propResumeSections.education"
        :title="propResumeSections.education.title"
      >
        <v-layout
          v-for="(education, i) in propResumeSections.education.items"
          :key="i"
        >
          <v-flex
            md3
            pr-2
          >
            <div class="no-wrap">
              {{ education.years }}
            </div>
          </v-flex>
          <v-flex md9>
            <strong v-html="education.name" /><br>
            <small>
              <i>{{ education.location }}</i>
            </small>
            <div v-html="education.text" /><br>
          </v-flex>
        </v-layout>
      </content-section>
      <content-section
        v-if="propResumeSections.skills"
        :title="propResumeSections.skills.title"
      >
        <template slot="actions">
          (% are relative not absolute)
        </template>
        <v-layout wrap>
          <template
            v-for="(skill, i) in propResumeSections.skills.items"
          >
            <v-flex
              v-if="skill.divider"
              :key="i"
              md12
              xs12
              mb-4
            />
            <v-flex
              v-else
              :key="i"
              md6
              xs12
            >
              <div
                class="mr-2 ml-2"
              >
                <div class="align-center">
                  <v-icon
                    small
                  >
                    {{ skill.icon }}
                  </v-icon>
                  {{ skill.name }}
                </div>
                <v-progress-linear
                  class="progress"
                  color="secondary"
                  height="3"
                  :value="skill.value"
                />
              </div>
            </v-flex>
          </template>
        </v-layout>
      </content-section>
    </v-card-text>
  </v-card>
</template>

<script>
import ContentSection from '@/views/dark-template/content/Section'
export default {
  name      : 'MainContent',
  components: { ContentSection },
  props     : { propResumeSections: { type: Object, default: () => {} } },
}
</script>

<style scoped>
.title {
  border-bottom: 2px #bfbfbf solid;
  line-height: 1.5 !important;
}
.progress {
  margin-top: 0.1rem;
}
</style>
