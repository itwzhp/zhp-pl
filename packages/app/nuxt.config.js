
export default {
  /*
  ** Nuxt rendering mode
  ** See https://nuxtjs.org/api/configuration-mode
  */
  mode: 'universal',
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
      { rel: 'icon', type: 'image/png', href: '/16.png' },
      { rel: 'apple-touch-icon', href: '/144.png' },
      { rel: 'apple-touch-icon', sizes: '76x76', href: '/76.png' },
      { rel: 'apple-touch-icon', sizes: '114x114', href: '/114.png' },
      { rel: 'apple-touch-icon', sizes: '144x144', href: '/144.png' }
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
    // Doc: https://github.com/nuxt-community/eslint-module
    '@nuxtjs/eslint-module',
    // Doc: https://github.com/nuxt-community/stylelint-module
    '@nuxtjs/stylelint-module',
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
    baseURL: 'https://demo.przemyslawspaczek.pl/wp-json/wp/v2'
  },
  /*
  ** Build configuration
  ** See https://nuxtjs.org/api/configuration-build/
  */
  build: {
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
  }
}
