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
    '@nuxtjs/sentry',
    'nuxt-facebook-pixel-module',
    [
      '@netsells/nuxt-hotjar', {
        id: process.env.HJID,
        sv: process.env.HJSV
      }
    ]
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
  sentry: {
    dsn: process.env.DSN,
    config: {
      environment: process.env.NODE_ENV
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
      const year = new Date().getFullYear()
      for (let y = 2010; y <= year; y++) {
        routes.push({
          name: `slug-${y}`,
          path: `/${y}/:slug`,
          component: resolve(__dirname, 'pages/aktualnosci/_slug.vue')
        })
        routes.push({
          name: `${y}`,
          path: `/${y}`,
          component: resolve(__dirname, 'pages/aktualnosci/_slug.vue')
        })
      }
      sortRoutes(routes)
    }
  }
}
