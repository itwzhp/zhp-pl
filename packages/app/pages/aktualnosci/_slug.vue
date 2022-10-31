<template>
  <div id="post">
    <ZSection
      tag="div"
      class="section"
    >
      <ZHeading
        :level="1"
        class="title t3"
      >
        {{ post.title.rendered }}
      </ZHeading>
      <ZMetaPost
        :author="{name: post.rest_author.name, avatarUrl: post.rest_author['avatar_url']}"
        :reading-time="post.rest_reading_time"
        :date="post.date"
        :categories="post._embedded['wp:term'][0]"
        class="meta"
      />
      <figure
        v-if="post._embedded['wp:featuredmedia'] && post._embedded['wp:featuredmedia'][0].media_details"
        class="thumbnail"
      >
        <ZImage
          :src="post._embedded['wp:featuredmedia'][0].media_details.sizes.full.source_url"
          class="cover"
        />
        <ZText
          v-if="post._embedded['wp:featuredmedia'][0].caption.rendered"
          tag="figcaption"
          class="caption"
          v-html="`fot. ${post._embedded['wp:featuredmedia'][0].caption.rendered}`"
        />
      </figure>
      <ZWordPress
        :html="post.content && post.content.rendered"
        class="content"
      />
      <ZFiles
        v-if="hasFiles"
        title="Linki i dokumenty powiązane z artykułem:"
        :files="files"
        class="files"
      />
      <div class="sidebar">
        <div class="z-news">
          <ZHeading class="t6 z-news__heading">
            Warto przeczytać
          </ZHeading>
          <ZList>
            <template v-for="news in newses">
              <ZListItem
                :key="news.id"
                class="z-news__item"
              >
                <ZLink
                  :to="news.rest_redirect ? news.rest_redirect : `/${post.date.split('-')[0]}/${news.slug}`"
                  class="z-news__title"
                  v-html="news.title.rendered"
                />
                <div class="light body-2">
                  {{ news.date | format }} {{ news.rest_author.name }}
                </div>
              </ZListItem>
            </template>
          </ZList>
        </div>
      </div>
    </ZSection>
    <ZSection
      class="related section"
      title="Mogą Cię także zainteresować:"
    >
      <ZCarousel
        v-if="relatedPosts.length > 0"
        :peeked="true"
        :settings="{
          breakpoints: {
            640: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="related__carousel"
      >
        <template v-for="relatedPost in relatedPosts">
          <li
            :key="relatedPost.id"
            class="glide__slide"
          >
            <ZPost
              :key="relatedPost.id"
              :thumbnail="relatedPost.rest_media || placeholder"
              :title="relatedPost.title.rendered"
              :to="relatedPost.rest_redirect ? relatedPost.rest_redirect : `/${relatedPost.date.split('-')[0]}/${relatedPost.slug}`"
              :author="relatedPost.rest_author"
              :sticky="relatedPost.sticky"
              :date="relatedPost.date"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
  </div>
</template>

<script>
import { format } from 'date-fns'
import {
  ZSection,
  ZHeading,
  ZMetaPost,
  ZImage,
  ZCarousel,
  ZPost,
  ZFiles,
  ZList,
  ZLink,
  ZText
} from '@zhp-pl/ui'
import ZWordPress from '@/components/organisms/ZWordPress.vue'
import { mapGetters } from 'vuex'

export default {
  name: 'Post',
  filters: {
    format (date) {
      if (!date) {
        return ''
      }
      return format(new Date(date), 'dd.MM.yyyy')
    }
  },
  components: {
    ZSection,
    ZHeading,
    ZMetaPost,
    ZImage,
    ZCarousel,
    ZPost,
    ZWordPress,
    ZFiles,
    ZList,
    ZLink,
    ZText
  },
  async asyncData ({ $axios, params, query, redirect }) {
    // posts
    const postRes = await $axios.get('posts', { params: { _embed: true, ...params } })

    if (!postRes.data.length) {
      redirect({ name: '404' })
    }

    const post = postRes.data.shift()
    const postRedirect = post.rest_redirect
    if (postRedirect) {
      redirect(postRedirect)
    }

    // related posts
    const relatedPostsRes = await $axios.get('posts', { params: { per_page: 8, categories: post.categories.shift() } })
    const relatedPosts = relatedPostsRes.data
    // files
    const files = Array.isArray(post.rest_acf.plikilinki)
      ? post.rest_acf.plikilinki.map(file => ({
        ...file,
        type: file.file ? 'Dokument' : 'Link',
        date: file.file.modified
      }))
      : []

    return { post, relatedPosts, files }
  },
  computed: {
    ...mapGetters({
      title: 'theme/title',
      placeholder: 'theme/placeholder'
    }),
    hasFiles () {
      return this.files.length > 0
    },
    newses () {
      return this.$store.getters['posts/posts'].filter(post => (post.id !== this.post.id)).slice(0, 4)
    }
  },
  head () {
    const title = this.post.title.rendered + ' | ' + this.title
    const description = ''
    const image = this.post._embedded['wp:featuredmedia'] && this.post._embedded['wp:featuredmedia'][0].media_details
      ? this.post._embedded['wp:featuredmedia'][0].media_details.sizes.full.source_url
      : this.placeholder
    return {
      title,
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: description
        },
        // Open Graph
        {
          hid: 'og:title',
          property: 'og:title',
          content: title
        },
        {
          hid: 'og:description',
          property: 'og:description',
          content: description
        },
        {
          hid: 'og:image',
          property: 'og:image',
          content: image
        },
        // Twitter Card
        {
          hid: 'twitter:title',
          property: 'twitter:title',
          content: title
        },
        {
          hid: 'twitter:description',
          property: 'twitter:description',
          content: description
        }
      ]
    }
  }
}
</script>

<style lang="scss">
#post {
  overflow: hidden;

  .section {
    --section-margin: 25px 0;
  }

  .title {
    margin: 32px 0;
    grid-column: span 12;
    grid-row: 1;
  }

  .meta {
    margin: 0 0 24px 0;
    grid-column: span 12;
    grid-row: 2;

    @media (min-width: 640px) {
      grid-column: span 8;
    }
  }

  .thumbnail {
    margin: 0;
    grid-column: span 12;
    grid-row: 3;

    @media (min-width: 640px) {
      grid-column: span 8;
    }
  }

  .cover {
    display: flex;
    overflow: hidden;
    height: 198px;
    border-radius: 10px;

    @media (min-width: 640px) {
      height: 396px;
    }

    & .z-image,
    & img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (min-width: 640px) {
      grid-column: span 8;
    }
  }

  .content {
    grid-column: span 12;
    grid-row: 4;

    @media (min-width: 640px) {
      grid-column: span 8;
    }
  }

  .sidebar {
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 4;
      grid-row: 3 / span 3;
    }
  }

  .files {
    margin: 48px 0 0 0;
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 8;
      grid-row: 5;
    }
  }

  .related {
    &__title {
      grid-column: span 12;
      place-self: center;
    }

    &__carousel {
      grid-column: span 12;
    }
  }

  .image {
    display: flex;
    overflow: hidden;
    border-radius: 10px;
  }
}

.z-news {
  padding: 20px;
  background: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0 10px 30px 0 rgba(209, 213, 223, 0.5);

  &__heading {
    margin: 0 0 32px 0;
    color: var(--color-primary);
  }

  &__item {
    margin: 0 0 24px 0;

    &:last-of-type {
      margin: 0;
    }
  }

  &__title {
    display: inline-block;
    margin: 0 0 0.5rem 0;
  }
}
</style>
