
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
    ],
    script: [
      { async: true, defer: true, crossorigin: 'anonymous', src: 'https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v9.0&appId=2797653613806518&autoLogAppEvents=1', nonce: '1i8tQDha' }
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
  plugins: [
  ],
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
    '@nuxtjs/pwa'
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/pwa'
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
    extend (config, context) {
      config.resolve.alias = {
        ...config.resolve.alias,
        vue$: 'vue/dist/vue.esm.js'
      }
    },
    transpile: [/^@nowa-zhp/]
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
  }
}
