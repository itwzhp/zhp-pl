import { sortRoutes } from '@nuxt/utils'
export default {
  target: 'server',
  head: {
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' },
      { rel: 'stylesheet', href: 'https://use.typekit.net/lqw5sjc.css' }
    ],
    link: [
      { rel: 'stylesheet', href: 'https://use.typekit.net/lqw5sjc.css' },
      { hid: 'icon-512x512', rel: 'icon', type: 'image/png', sizes: '512x512', href: '/wp-content/themes/zhp-pl/favicon.png' },
      { hid: 'icon-128x128', rel: 'icon', type: 'image/png', sizes: '128x128', href: '/wp-content/themes/zhp-pl/favicon.png' },
      { hid: 'icon-32x32', rel: 'icon', type: 'image/png', sizes: '32x32', href: '/wp-content/themes/zhp-pl/favicon.png' }
    ]
  },
  css: [
    '@zhp-pl/ui/src/styles/styles.scss'
  ],
  plugins: [],
  buildModules: [],
  modules: ['@nuxtjs/axios', '@nuxtjs/pwa'],
  axios: { baseURL: process.env.REST_API },
  pwa: {
    meta: {
      name: "Związek Harcerstwa Polskiego",
      theme: '#78a22f'
    },
    manifest: {
      name: 'Związek Harcerstwa Polskiego',
      tag: 'pl',
      useWebmanifestExtension: false
    }
  },
  build: {
    extend(config, { isClient }) {
      config.resolve.alias = {
        ...config.resolve.alias,
        vue$: 'vue/dist/vue.esm.js'
      }
    },
    transpile: [/^@zhp-pl/, '@glidejs'],
    publicPath: '/wp-content/themes/zhp-pl/_nuxt'
  },
  publicRuntimeConfig: {},
  router: {
    extendRoutes(routes, resolve) {
      routes.push({
        name: 'custom',
        path: '*',
        component: resolve(__dirname, 'pages/404.vue')
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
  ssr: process.env.SSR == 'true',
  generate: {
    exclude: [/^\/.+/],
    subFolders: false,
    fallback: false
  }
}
