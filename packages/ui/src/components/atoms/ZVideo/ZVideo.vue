<template>
  <video controls>
    <source
      src="http://prod.przemyslawspaczek.pl/wp-content/uploads/2020/11/Harcerskielatp2019.mp4"
      type="video/mp4"
    >
    Sorry, your browser doesn't support embedded videos.
  </video>
</template>

<script>
export default {
  name: 'ZVideo',
  props: {
    yt: {
      type: String,
      default: '',
    },
  },
};
</script>
