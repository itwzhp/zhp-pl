<template>
  <div id="events">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <ZHeading style="grid-column: 1 / span 4;">
        Wydarzenia
        <small
          style="display: block;
        margin: 8px 0;
        font-weight: 400;"
        >Znajdź wydarzenia dla siebie i swojej drużyny</small>
      </ZHeading>
    </div>
    <!-- Wyróżnione wydarzenie -->
    <!-- Wydarzenia -->
    <div style="display: grid; max-width: 1120px; margin: 32px auto; gap: 20px; grid-template-columns: repeat(4, 1fr);">
      <div style=" display: grid; grid-column: 1; grid-row: span 4; grid-template-rows: repeat(4, 1fr);">
        <form
          style=" padding: 24px;
        border-radius: 10px;
        box-shadow: 0 2px 4px 0 rgba(157, 157, 157, 0.5);
        grid-row: span 3;"
        >
          <ZHeading :level="3">
            Filtry
          </ZHeading>
          <ZHeading :level="4">
            Aktywne filtry
          </ZHeading>
          <div>
            <ZText
              tag="label"
              for="types"
              style="display: block;"
            >
              Rodzaj wydarzenia
            </ZText>
            <select id="types">
              <option>Obóz</option>
              <option>Zlot</option>
              <option>Konferencja</option>
            </select>
          </div>
          <div>
            <ZText
              tag="label"
              for="ageGroups"
              style="display: block;"
            >
              Metodyka
            </ZText>
            <select id="ageGroups">
              <option>Zuchy</option>
              <option>Harcerze</option>
              <option>Harcerze Stars</option>
              <option>Wędrownicy</option>
            </select>
          </div>
          <div>
            <ZText
              tag="label"
              for="districts"
              style="display: block;"
            >
              Metodyka
            </ZText>
            <select id="districts">
              <option>Opolskie</option>
              <option>Dolnoślaskie</option>
              <option>Slaskie</option>
            </select>
          </div>
          <div>
            <!-- todo: jak to wspierać, jak oganire to acf -->
            <!-- todo: datatime dla between -->
            <label for="date">Data wydarzenia</label>
            <input
              id="date"
              type="date"
            >
          </div>
          <div
            style="display: grid;
    max-width: 1120px;
    justify-content: end;
    margin: 32px auto;
    column-gap: 8px;
    grid-auto-flow: column;"
          >
            <ZButton style="--icon-color: #fff; width: 34px; height: 34px;">
              <ZIcon name="cross" />
            </ZButton>
            <ZButton style="--icon-color: #fff; width: 34px; height: 34px;">
              <ZIcon name="approved" />
            </ZButton>
          </div>
        </form>
      </div>
      <template v-for="(event) in events">
        <ZEvent
          :key="event.id"
          :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${event.rest_media.file}`"
          :title="event.title.rendered"
          :date="event.rest_acf.date"
          :location="{name: 'Warszawa'}"
          :audience="{name: 'Wszyscy harcerze'}"
          :type="event.rest_event_type"
          :age-group="event.rest_age_group"
        />
      </template>
    </div>
    <!-- Paginacja -->
    <div
      style="display: grid;
    max-width: 1120px;
    justify-content: end;
    margin: 32px auto;
    column-gap: 8px;
    grid-auto-flow: column;"
    >
      <ZButton style="--icon-color: #fff; width: 34px; height: 34px;">
        <ZIcon name="arrow-left" />
      </ZButton>
      <ZButton style="--icon-color: #fff; width: 34px; height: 34px;">
        <ZIcon name="arrow-right" />
      </ZButton>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import {
  ZEvent, ZHeading, ZButton, ZIcon, ZText,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZEvent,
    ZHeading,
    ZButton,
    ZIcon,
    ZText,
  },
  data() {
    return {
      events: [],
    };
  },
  async created() {
    const { API_URL } = process.env;
    const params = {
      per_page: 12,
    };
    const eventsRes = await axios.get(`${API_URL}/events`, { params });
    this.events = eventsRes.data;
  },
};
</script>
<style lang="scss">
  #events {}
</style>
