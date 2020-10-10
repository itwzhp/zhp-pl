<template>
  <div id="post">
    <ZSection tag="div">
      <ZHeading
        :level="1"
        class="title t3"
      >
        {{ post.title.rendered }}
      </ZHeading>
      <ZMeta
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
      <ZWordPress :html="post.content && post.content.rendered" class="content" />
      <div v-if="filesMock" class="z-files files">
        <!-- linki i dokumenty powiązane z artykułem -->
        <ZHeading
          :level="3"
          class="z-files__title body-1"
        >
          Linki i dokumenty powiązane z artykułem
        </ZHeading>
        <ZList class="z-files__files">
          <template v-for="(file, key) in filesMock">
            <li :key="key">
              <div class="z-file">
                <div class="z-file__type caption">
                  {{ file.type }}
                </div>
                <ZLink
                  :to="file.url"
                  class="z-file__name t6"
                >
                  {{ file.name }}
                </ZLink>
                <div class="z-file__meta">
                  {{ file.mimeType }}, {{ file.date }}
                </div>
              </div>
            </li>
          </template>
        </ZList>
      </div>
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
              :to="`/posts/${relatedPost.slug}`"
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
  ZMeta,
  ZImage,
  ZCarousel,
  ZPost,
  ZLink,
  ZList,
  ZWordPress
} from '@nowa-zhp/ui'

export default {
  name: 'Post',
  components: {
    ZSection,
    ZHeading,
    ZMeta,
    ZImage,
    ZCarousel,
    ZPost,
    ZLink,
    ZList,
    ZWordPress
  },
  async asyncData ({ $axios, params, query }) {
    // posts
    const postRes = await $axios.get('posts', { params })
    const post = postRes.data[0]
    // related posts
    const relatedPostsRes = await $axios.get('posts', { per_page: 8 })
    const relatedPosts = relatedPostsRes.data
    // filesMock
    const filesMock = [
      { type: 'Link', name: 'Rejestracja patroli', url: '#' },
      {
        type: 'Dokument', name: 'Formularz zgłoszeniowy', url: '#', date: '12.07.2020', mimeType: 'Dokument Word'
      },
      {
        type: 'Dokument', name: 'Formularz zgłoszeniowy', url: '#', date: '12.07.2020', mimeType: 'Dokument PDF'
      }
    ]

    return { post, relatedPosts, filesMock }
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

.z-files {
  &__title {
    margin: 1rem 0;
  }

  &__files {
    display: grid;
    gap: 12px;
    grid-auto-flow: row;
  }
}

.z-file {
  position: relative;
  display: grid;
  align-items: center;
  justify-content: space-between;
  padding: 32px 16px;
  border: 1px solid #a6ce39;
  border-radius: 2px;
  grid-template-columns: repeat(2, auto);

  //&__name {}

  &__type {
    position: absolute;
    top: 8px;
    left: 8px;
  }

  &__meta {
    color: #a6ce39;
  }
}
</style>
