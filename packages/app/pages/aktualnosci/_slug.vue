<template>
  <div id="post">
    <ZSection tag="div">
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
        :categories="post.categories"
        class="meta"
      />
      <ZImage
        :src="post.rest_media"
        class="cover"
      />
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
&nbsp;
      </div>
    </ZSection>
    <ZSection class="related">
      <ZHeading class="related__title t4 uppercase">
        Mogą Cię także zainteresować:
      </ZHeading>
      <ZCarousel
        v-if="relatedPosts.length > 0"
        :peeked="true"
        :settings="{
          breakpoints: {
            480: {
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
              :thumbnail="relatedPost.rest_media"
              :title="relatedPost.title.rendered"
              :to="`/aktualnosci/${relatedPost.slug}`"
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
import {
  ZSection,
  ZHeading,
  ZMetaPost,
  ZImage,
  ZCarousel,
  ZPost,
  ZWordPress,
  ZFiles
} from '@nowa-zhp/ui'

export default {
  name: 'Post',
  components: {
    ZSection,
    ZHeading,
    ZMetaPost,
    ZImage,
    ZCarousel,
    ZPost,
    ZWordPress,
    ZFiles
  },
  async asyncData ({ $axios, params, query }) {
    // posts
    const postRes = await $axios.get('posts', { params })
    const post = postRes.data[0]
    // related posts
    const relatedPostsRes = await $axios.get('posts', { per_page: 8 })
    const relatedPosts = relatedPostsRes.data
    // files
    const files = post.rest_acf.plikilinki
      ? post.rest_acf.plikilinki.map(file => ({
        ...file,
        type: file.file ? 'Dokument' : 'Link',
        date: file.file.modified
      }))
      : []

    return { post, relatedPosts, files }
  },
  computed: {
    hasFiles () {
      return this.files.length > 0
    }
  }
}
</script>

<style lang="scss">
#post {
  overflow: hidden;

  .title {
    margin: 32px 0;
    grid-column: span 12;
    grid-row: 1;
  }

  .meta {
    margin: 0 0 24px 0;
    grid-column: span 12;
    grid-row: 2;

    @media (min-width: 480px) {
      grid-column: span 8;
    }
  }

  .cover {
    display: flex;
    overflow: hidden;
    height: 396px;
    border-radius: 10px;
    grid-column: span 12;
    grid-row: 3;

    & .z-image,
    & img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (min-width: 480px) {
      grid-column: span 8;
    }
  }

  .content {
    margin: 0 0 48px 0;
    grid-column: span 12;
    grid-row: 4;

    @media (min-width: 480px) {
      grid-column: span 8;
    }
  }

  .sidebar {
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 4;
      grid-row: 3 / span 3;
    }
  }

  .files {
    grid-column: span 12;

    @media (min-width: 480px) {
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
</style>
