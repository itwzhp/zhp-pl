import { sortRoutes } from '@nuxt/utils'
export default {
  /*
  ** Nuxt target
  ** See https://nuxtjs.org/api/configuration-target
  */
  target: 'server',
  /*
  ** Headers of the page
  ** See https://nuxtjs.org/api/configuration-head
  */
  head: {
    title: 'Związek Harcerstwa Polskiego',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' },
      { rel: 'stylesheet', href: 'https://use.typekit.net/lqw5sjc.css' }
    ],
    link: [
      { rel: 'stylesheet', href: 'https://use.typekit.net/lqw5sjc.css' },
      { rel: 'icon', type: 'image/png', href: '/favicon.png' }
    ]
  },
  /*
  ** Global CSS
  */
  css: [
    '@nowa-zhp/ui/src/styles/styles.scss'
  ],
  /*
  ** Plugins to load before mounting the App
  ** https://nuxtjs.org/guide/plugins
  */
  plugins: ['~plugins/fragment'],
  /*
  ** Auto import components
  ** See https://nuxtjs.org/api/configuration-components
  */
  components: true,
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    // '@nuxtjs/eslint-module',
    // '@nuxtjs/stylelint-module',
    '@nuxtjs/pwa',
    '@nuxtjs/google-analytics'
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    '@nuxtjs/sentry'
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    baseURL: process.env.REST_API
  },
  /*
  ** Build configuration
  ** See https://nuxtjs.org/api/configuration-build/
  */
  build: {
    extend (config, { isClient }) {
      if (isClient) {
        config.optimization.splitChunks.maxSize = 200000
      }
      config.resolve.alias = {
        ...config.resolve.alias,
        vue$: 'vue/dist/vue.esm.js'
      }
    },
    transpile: [/^@nowa-zhp/],
    extractCSS: true
  },
  pwa: {
    meta: {
      name: 'Związek Harcerstwa Polskiego',
      theme_color: '#78a22f'
    },
    manifest: {
      name: 'Związek Harcerstwa Polskiego',
      lang: 'pl',
      useWebmanifestExtension: false
    }
  },
  publicRuntimeConfig: {
    mediaBaseURL: process.env.MEDIA_BASE_URL
  },
  sentry: {
    dsn: 'https://dbc6503ec4004c37a3f7706daa89aa73@o479654.ingest.sentry.io/5524988',
    config: {
      environment: process.env.NODE_ENV
    }
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
  },
  googleAnalytics: {
    id: process.env.GA
  },
  telemetry: false
}
