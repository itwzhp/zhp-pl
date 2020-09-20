<template>
  <div id="article">
    <ZSection tag="div">
      <ZHeading
        :level="1"
        style="grid-column: span 12;"
      >
        {{ title }}
      </ZHeading>
    </ZSection>
    <ZSection tag="div">
      <div style="grid-column: span 8;">
        <div>
          <!-- {Avatar, Autor} = user, Kategorie,-->
          <!-- Data, ~5 min czytania -->
        </div>
        <ZImage />
        <div>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur delectus, doloremque ducimus earum
            error expedita ipsam modi officia, placeat quaerat repellat repudiandae rerum tempora tenetur totam velit
            voluptate voluptatem voluptates.
          </p>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur delectus, doloremque ducimus earum
            error expedita ipsam modi officia, placeat quaerat repellat repudiandae rerum tempora tenetur totam velit
            voluptate voluptatem voluptates.
          </p>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur delectus, doloremque ducimus earum
            error expedita ipsam modi officia, placeat quaerat repellat repudiandae rerum tempora tenetur totam velit
            voluptate voluptatem voluptates.
          </p>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur delectus, doloremque ducimus earum
            error expedita ipsam modi officia, placeat quaerat repellat repudiandae rerum tempora tenetur totam velit
            voluptate voluptatem voluptates.
          </p>
        </div>
        <div>
          <!-- linki i dokumenty powiązane z artykułem -->
          <ZHeading :level="3">
            Linki i dokumenty powiązane z artykułem
          </ZHeading>
          <ul>
            <li>
              <div>
                <div>Link</div>
                <ZHeading :level="4">
                  Rejestracja patroli
                </ZHeading>
              </div>
            </li>
            <li>
              <div>
                <div>Dokument</div>
                <ZHeading :level="4">
                  Formularz zgłoszeniowy
                </ZHeading>
                <div>Dokument Word, 12.07.2019</div>
              </div>
            </li>
            <li>
              <div>
                <div>Dokument</div>
                <ZHeading :level="4">
                  Formularz zgłoszeniowy
                </ZHeading>
                <div>Dokument PDF, 12.07.2019</div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div style="grid-column: span 4;">
        Sidebar
      </div>
    </ZSection>
    <!-- Mogą cię także zaintersować -->
    <ZSection>
      <ZHeading style="grid-column: span 12; place-self: center;">
        Mogą Cię także zainteresować:
      </ZHeading>
      <ZCarousel
        v-if="false"
        style="grid-column: span 12;"
      />
    </ZSection>
  </div>
</template>

<script>
import {
  ZSection,
  ZHeading,
  ZCarousel,
  ZImage,
} from '../../../index';

export default {
  name: 'Article',
  components: {
    ZImage,
    ZHeading,
    ZSection,
    ZCarousel,
  },
  data() {
    return {
      title: 'Europejskie Jamboree 2020: Oferta współpracy dla baz i miejsc obozowych',
    };
  },
};
</script>

<style lang="scss">
</style>
