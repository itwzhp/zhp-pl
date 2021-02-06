<template>
  <ZForm
    novalidate
    @submit.prevent="submitHandler"
    @click:cancel="cancelHandler"
  >
    <ZHeading class="t4 uppercase">
      Twoje wydarzenie
    </ZHeading>
    <ZText class="caption">
      Gingerbread gummi bears tootsie roll chocolate bonbon marshmallow bonbon brownie lemon drops.
    </ZText>
    <ZAccordion first-open="Organizator">
      <ZAccordionItem title="Organizator">
        <ZText class="caption">
          Donut danish cotton candy. Gingerbread pudding candy canes cheesecake jelly-o cheesecake cupcake.
        </ZText>
        <ZFormField
          v-model="person"
          label="Imię i nazwisko"
          :required="true"
        />
        <ZFormField
          v-model="unit"
          label="Jednostka"
          :required="true"
        />
        <ZFormField
          v-model="phone"
          type="tel"
          label="Telefon kontaktowy"
        />
        <ZFormField
          v-model="mail"
          type="mail"
          label="Mail kontaktowy"
          :required="true"
        />
      </ZAccordionItem>
      <ZAccordionItem title="Wydarzenie">
        <ZText class="caption">
          Donut danish cotton candy. Gingerbread pudding candy canes cheesecake jelly-o cheesecake cupcake.
        </ZText>
        <ZFormField
          v-model="title"
          label="Nazwa"
          :required="true"
        />
        <ZFormField
          v-model="web"
          label="WWW"
        />
        <ZFormField
          v-model="web"
          label="Okładka wydarzenia"
          :required="true"
        >
          <template #input="{id}">
            <input
              :id="id"
              type="file"
              @change="uploadHandler"
            >
          </template>
        </ZFormField>
        <ZFormField
          label="Opis"
          :required="true"
        >
          <template #input="{id}">
            <ZTextarea
              :id="id"
              v-model="description"
              rows="5"
            />
          </template>
        </ZFormField>
        <ZFormField
          label="Warunki uczestnictwa"
          :required="true"
        >
          <template #input="{id}">
            <ZTextarea
              :id="id"
              v-model="conditions"
              rows="5"
            />
          </template>
        </ZFormField>
        <ZFormField
          label="Miejsce"
          :required="true"
        >
          <template #input="{id}">
            <ZTextarea
              :id="id"
              v-model="place"
              rows="5"
            />
          </template>
        </ZFormField>
        <ZFormField
          label="Kiedy"
          :required="true"
        >
          <template #input>
            <ZDatePicker
              v-model="date"
              tag="input"
              placeholder="Wybierz przedział"
              :settings="{
                inline: false,
                dateFormat: 'd/m/Y',
                maxDate: null
              }"
              class="z-input"
            />
          </template>
        </ZFormField>
        <ZFormField
          label="Rodzaj wydarzenia"
          :required="true"
        >
          <template #input="{id}">
            <ZSelect
              :id="id"
              v-model="event_type"
              :options="categories.event_types.options"
              class="z-form-field__input"
            />
          </template>
        </ZFormField>
        <ZFormField
          label="Metodyka"
          :required="true"
        >
          <template #input="{id}">
            <ZSelect
              :id="id"
              v-model="age_group"
              :multiple="true"
              size="5"
              :options="categories.age_groups.options"
              class="z-form-field__input"
            />
          </template>
        </ZFormField>
        <ZFormField
          label="Województwo"
          :required="true"
        >
          <template #input="{id}">
            <ZSelect
              :id="id"
              v-model="localization"
              :options="categories.localizations.options"
              class="z-form-field__input"
            />
          </template>
        </ZFormField>
      </ZAccordionItem>
    </ZAccordion>
  </ZForm>
</template>

<script>
import {
  ZHeading,
  ZText,
  ZFormField,
  ZAccordion,
  ZTextarea,
  ZSelect,
  ZDatePicker,
  ZForm
} from '@nowa-zhp/ui'

export default {
  name: 'NewEventModal',
  components: {
    ZHeading,
    ZText,
    ZFormField,
    ZAccordion,
    ZTextarea,
    ZSelect,
    ZDatePicker,
    ZForm
  },
  props: {
    categories: {
      type: Object,
      default: () => ({})
    }
  },
  data () {
    return {
      person: '',
      unit: '',
      phone: '',
      mail: '',
      title: '',
      web: '',
      file: null,
      description: '',
      conditions: '',
      place: '',
      date: [],
      event_type: '',
      age_group: [],
      localization: ''
    }
  },
  methods: {
    submitHandler () {
      const formData = new FormData()
      formData.append('person', this.person)
      formData.append('unit', this.unit)
      formData.append('phone', this.phone)
      formData.append('mail', this.mail)
      formData.append('title', this.title)
      formData.append('web', this.web)
      formData.append('file', this.file)
      formData.append('description', this.description)
      formData.append('conditions', this.conditions)
      formData.append('place', this.place)
      formData.append('begin', this.data[0])
      formData.append('end', this.data[1])
      formData.append('event_type', this.event_type)
      formData.append('age_group', this.age_group)
      formData.append('localization', this.localization)
      this.$emit('submit', formData)
    },
    cancelHandler () {
      this.person = ''
      this.unit = ''
      this.phone = ''
      this.mail = ''
      this.title = ''
      this.web = ''
      this.file = null
      this.description = ''
      this.conditions = ''
      this.place = ''
      this.date = []
      this.event_type = ''
      this.age_group = []
      this.localization = ''
      this.$emit('click:close')
    },
    uploadHandler (event) {
      const file = event.target.files[0]
      const img = new Image()
      img.onload = function () {
        alert(`width: ${this.width} height: ${this.height}`)
      }
      img.src = URL.createObjectURL(file)
      this.file = file
    }
  }
}
</script>

<style lang="scss">
.new-event-form {
  cursor: auto;
}
</style>
