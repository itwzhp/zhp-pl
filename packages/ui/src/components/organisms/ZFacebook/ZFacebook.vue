<template>
  <div class="zb-page z-facebook">
    <div
      class="fb-page"
      :data-href="fbPageUrl"
      data-tabs="timeline"
      data-width="260"
      :data-height="height"
      data-small-header="false"
      data-adapt-container-width="true"
      data-hide-cover="false"
      data-show-facepile="true"
      data-lazy="true"
    />
  </div>
</template>

<script>
export default {
  name: 'ZFacebook',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    appId: {
      type: String,
      default: ''
    },
    fbPageUrl: {
      type: String,
      default: ''
    },
    height: {
      type: Number,
      default: ''
    }
  },
  mounted() {
    const installFacebookSdkScript = (d, s, id) => {
      if (d.getElementById(id)) {
        this.facebookSdkReady = true;
        return;
      }
      const fjs = d.getElementsByTagName(s)[0];
      const js = d.createElement(s);
      js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk.js';
      fjs.parentNode.insertBefore(js, fjs);
    };
    installFacebookSdkScript(document, 'script', 'facebook-jssdk');
    window.fbAsyncInit = () => {
      FB.init({
        appId: this.appId,
        cookie: true,
        xfbml: true,
        version: 'v3.2',
      });
    };
  },
};
</script>