<template>
  <div
    class="fb-page z-facebook"
    :data-href="fbPageUrl"
    data-tabs="timeline"
    data-width="500"
    :data-height="height"
    data-small-header="false"
    data-adapt-container-width="true"
    data-hide-cover="false"
    data-show-facepile="true"
    data-lazy="true"
  />
</template>

<script>
export default {
  name: 'ZFacebook',
  props: {
    appId: {
      type: String,
      default: ''
    },
    fbPageUrl: {
      type: String,
      default: ''
    },
    height: {
      type: String,
      default: ''
    }
  },
  mounted () {
    const installFacebookSdkScript = (d, s, id) => {
      if (d.getElementById(id)) {
        this.facebookSdkReady = true
        return
      }
      const fjs = d.getElementsByTagName(s)[0]
      const js = d.createElement(s)
      js.id = id
      js.src = 'https://connect.facebook.net/en_US/sdk.js'
      fjs.parentNode.insertBefore(js, fjs)
    }
    installFacebookSdkScript(document, 'script', 'facebook-jssdk')
    window.fbAsyncInit = () => {
      FB.init({
        appId: this.appId,
        cookie: true,
        xfbml: true,
        version: 'v3.2'
      })
    }
  }
}
</script>
