<template>
  <div id="child">
    <h1>{{ page[0].title && page[0].title.rendered }}</h1>
    <nuxt-link to="/sili-duchem-wychowanie-duchowe-i-religijne/witajcie">
      Witajcie
    </nuxt-link>
    <nuxt-link to="/sili-duchem-wychowanie-duchowe-i-religijne/kapelani-i-duszpasterze">
      Kapelani i duszpasterze
    </nuxt-link>
    <nuxt-child />
  </div>
</template>
<script>
export default {
  name: 'Page',
  watchQuery: true,
  async asyncData ({ $axios, params, query }) {
    const pageRes = await $axios.get('pages', { params })
    const page = pageRes.data
    return { page, params }
  }
}
</script>
