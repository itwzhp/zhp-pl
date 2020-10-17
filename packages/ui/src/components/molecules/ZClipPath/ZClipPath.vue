<template>
  <component
    :is="tag"
    class="z-clip-path"
  >
    <svg
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 569 446"
    >
      <g clip-path="url(#clip0)">
        <path
          d="M534.401 44.228c-20.411-26.2-51.843-46.1-85-44.087-59.527 3.6-96.338 71.557-154.3 85.484-29.415 7.084-60.175-.84-89.062-9.8-18.346-5.691-36.979-11.886-55.853-14.984h-.024a132.05 132.05 0 00-32.7-1.633c-1.153.1-2.281.24-3.362.408-30.616 2.641-51 14.936-64.017 26.366a98.512 98.512 0 00-17.409 19.066 148.158 148.158 0 00-15.7 28.767c-27.278 65.29-21.323 143.5 15.536 203.89 36.859 60.39 103.693 101.455 174.242 107.026 67.307 5.307 133.677-19.93 191.955-54 60.775-35.542 117.157-83.087 147.869-146.432 30.687-63.368 31.096-144.554-12.175-200.071z"
          fill="url(#paint0_linear)"
        />
      </g>
      <defs>
        <linearGradient
          id="paint0_linear"
          x1="196.677"
          y1=".001"
          x2="138.725"
          y2="410.769"
          gradientUnits="userSpaceOnUse"
        >
          <stop stop-color="#4A7B26" />
          <stop
            offset=".502"
            stop-color="#7BA22E"
          />
          <stop
            offset="1"
            stop-color="#A6CE39"
          />
        </linearGradient>
        <clipPath id="clip0">
          <path
            fill="#fff"
            d="M0 0h568.399v445.437H0z"
          />
        </clipPath>
      </defs>
    </svg>
    <svg
      height="0"
      width="0"
      class="svg-clip"
    >
      <defs>
        <clipPath
          id="clip"
          clipPathUnits="objectBoundingBox"
        >
          <path d="M0.506,0.011 c-0.118,0.028,-0.223,0.101,-0.319,0.18 c-0.047,0.039,-0.094,0.08,-0.129,0.131 c-0.036,0.051,-0.06,0.113,-0.057,0.176 c0.002,0.059,0.027,0.114,0.057,0.163 A0.694,0.738,0,0,0,0.802,0.98 c0.043,-0.011,0.092,-0.033,0.103,-0.078 c0.01,-0.041,-0.014,-0.083,-0.015,-0.125 c-0.002,-0.064,0.048,-0.115,0.077,-0.171 c0.044,-0.085,0.041,-0.19,0.01,-0.282 C0.923,0.165,0.815,0.024,0.651,0.003 a0.428,0.455,0,0,0,-0.145,0.008" />
        </clipPath>
      </defs>
    </svg>
    <ZImage
      src="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/news-DMB.png"
      class="image-clip"
    />
    <svg
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 607 486"
      style="z-index: 1;"
    >
      <path
        d="M107.481 78.28c-22.27 4.33-41.472 13.97-57.212 28.728a105.604 105.604 0 00-17.896 20.914A158.313 158.313 0 0016.6 159.139C-10.3 229.82-1.252 313.015 40.213 376.261c41.465 63.246 114.152 104.72 189.695 108.243 33.606 1.563 69.162-3.981 105.673-16.485 31.221-10.691 64.018-26.784 97.479-47.828 74.644-46.947 126.091-101.278 152.916-161.49 15.358-34.475 22.313-73.768 19.573-110.641-2.936-39.547-16.567-74.965-39.422-102.427-25.46-30.59-59.873-47.064-92.054-44.066-34.021 3.165-61.044 26.46-87.172 48.984-22.753 19.616-46.283 39.9-74.816 47.743-31.8 8.74-66.12.765-95.786-7.402-2.28-.626-4.562-1.258-6.847-1.896-17.406-4.834-35.407-9.833-53.333-12.2a141.018 141.018 0 00-34.953-.634 59.675 59.675 0 00-3.563.537c-3.44.409-6.813.934-10.12 1.577"
        stroke="#A6CE39"
      />
    </svg>
  </component>
</template>

<script>
import ZImage from '../../atoms/ZImage/ZImage.vue';

export default {
  name: 'ZClipPath',
  components: {
    ZImage,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
  },
};
</script>

<style lang="scss">
.z-clip-path {
  .svg-clip {
    width: 0;
    height: 0;
  }

  .image-clip {
    position: relative;
    width: 527px;
    height: 496px;
    clip-path: url(#clip);

    & .z-image,
    & img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }

  display: grid;
  align-items: center;
  justify-content: center;

  & > * {
    grid-column: 1;
    grid-row: 1;
  }
}
</style>
