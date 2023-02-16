import { sortRoutes } from '@nuxt/utils'
export default {
  target: 'server',
  ssr: true,
  head: {
    title: 'Związek Harcerstwa Polskiego',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'stylesheet', href: 'https://use.typekit.net/lqw5sjc.css' },
      { rel: 'icon', type: 'image/png', href: '/favicon.png' }
    ]
  },
  css: [
    '@zhp-pl/ui/src/styles/styles.scss'
  ],
  buildModules: [
    '@nuxtjs/pwa',
    '@nuxtjs/google-analytics'
  ],
  googleAnalytics: {
    id: process.env.GA
  },
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    'nuxt-facebook-pixel-module'
  ],
  axios: {
    baseURL: process.env.REST_API
  },
  pwa: {
    meta: {
      name: 'Związek Harcerstwa Polskiego',
      theme: '#78a22f'
    },
    manifest: {
      name: 'Związek Harcerstwa Polskiego',
      tag: 'pl',
      useWebmanifestExtension: false
    }
  },
  facebook: {
    track: 'PageView',
    pixelId: process.env.FB,
    autoPageView: true,
    disabled: false
  },
  build: {
    extend (config, { isClient }) {
      config.resolve.alias = {
        ...config.resolve.alias,
        vue$: 'vue/dist/vue.esm.js'
      }
    },
    transpile: [/^@zhp-pl/]
  },
  publicRuntimeConfig: {
    mediaBaseURL: process.env.MEDIA_BASE_URL
  },
  router: {
    scrollBehavior () {
      return { x: 0, y: 0 }
    },
    extendRoutes (routes, resolve) {
      routes.push({
        name: 'custom',
        path: '*',
        component: resolve(__dirname, 'pages/404.vue')
      })
      routes.push({
        name: 'dotacje-slug',
        path: '/dotacje/:slug',
        component: resolve(__dirname, 'pages/_slug.vue'),
        children: [
          {
            path: ':id',
            component: resolve(__dirname, 'pages/_slug/_id.vue'),
            name: 'dotacje-id'
          }
        ]
      })

      sortRoutes(routes)

      routes.unshift({
        name: `news-page`,
        path: `/:year([1-9][0-9]{3})/:slug`,
        component: resolve(__dirname, 'pages/aktualnosci/_slug.vue')
      })
      routes.unshift({
        name: `news-page-year`,
        path: `/:year([1-9][0-9]{3})`,
        component: resolve(__dirname, 'pages/aktualnosci/_slug.vue')
      })
    }
  }
}
