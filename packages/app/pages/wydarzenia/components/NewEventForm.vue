<template>
  <ZForm
    ref="scroll"
    class="new-event-form__form"
    novalidate
    @submit.prevent="submitHandler"
    @click:cancel="cancelHandler"
  >
    <ZHeading class="t4 uppercase">
      Twoje wydarzenie
    </ZHeading>
    <ZText class="caption">
      Wypełnij poniższy formularz w celu zgłoszenia swojego wydarzenia, które zostanie opublikowane po weryfikacji przez administrację strony.
    </ZText>
    <ZAccordion first-open="Organizator">
      <ZAccordionItem title="Organizator">
        <ZText class="caption">
          Wprowadź dane, które umożliwią kontakt z organizatorem wydarzenia.
        </ZText>
        <ZFormField
          v-model="form.person"
          label="Imię i nazwisko"
          :required="true"
          :class="{'has-error': $v.form.person.$dirty && !$v.form.person.required}"
        >
          <template #error>
            <div
              v-if="$v.form.person.$dirty && !$v.form.person.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          v-model="form.unit"
          label="Jednostka"
          :required="true"
          :class="{'has-error': $v.form.unit.$dirty && !$v.form.unit.required}"
        >
          <template #error>
            <div
              v-if="$v.form.unit.$dirty && !$v.form.unit.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          v-model="form.phone"
          type="tel"
          label="Telefon kontaktowy"
        />
        <ZFormField
          v-model="form.mail"
          type="mail"
          label="Mail kontaktowy"
          :required="true"
          :class="{'has-error': $v.form.mail.$dirty && !$v.form.mail.required}"
        >
          <template #error>
            <div
              v-if="$v.form.mail.$dirty && !$v.form.mail.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
      </ZAccordionItem>
      <ZAccordionItem title="Wydarzenie">
        <ZText class="caption">
          Wprowadź dane, które pozwolą przyszłym uczestnikom twojego wydarzenia dowiedzieć się o nim czegos więcej.
        </ZText>
        <ZFormField
          v-model="form.title"
          label="Nazwa"
          :required="true"
          :class="{'has-error': $v.form.title.$dirty && !$v.form.title.required}"
        >
          <template #error>
            <div
              v-if="$v.form.title.$dirty && !$v.form.title.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          v-model="form.web"
          label="WWW"
        />
        <ZFormField
          label="Okładka wydarzenia"
          :required="true"
          style="--form-field-label-margin: 0 0 4px 0;"
        >
          <template
            #input="{id}"
          >
            <ZText
              class="caption"
              style="margin: 4px 0 8px 0;"
            >
              Okładka wydarzenia powinna być plikiem graficznym i mieć wymiary nie mniejszy niż <b>727px&nbsp;x&nbsp;396px</b> i nie większy niż <b>1280px&nbsp;x&nbsp;720px</b>.
            </ZText>
            <input
              :id="id"
              ref="file"
              type="file"
              accept="image/*"
              @change="uploadHandler"
            >
          </template>
          <template #error>
            <div
              v-if="$v.form.file.$dirty && !$v.form.file.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          label="Opis"
          :required="true"
          :class="{'has-error': $v.form.description.$dirty && !$v.form.description.required}"
        >
          <template #input="{id}">
            <ZTextarea
              :id="id"
              v-model="form.description"
              rows="5"
            />
          </template>
          <template #error>
            <div
              v-if="$v.form.description.$dirty && !$v.form.description.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
            <div
              v-if="$v.form.place.$dirty && !$v.form.description.maxLength"
              class="z-form-field__error"
            >
              <div class="caption">
                * dozwolona długość tekstu to 500 znaków
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          label="Warunki uczestnictwa"
          :required="true"
          :class="{'has-error': $v.form.conditions.$dirty && !$v.form.conditions.required}"
        >
          <template #input="{id}">
            <ZTextarea
              :id="id"
              v-model="form.conditions"
              rows="5"
            />
          </template>
          <template #error>
            <div
              v-if="$v.form.conditions.$dirty && !$v.form.conditions.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
            <div
              v-if="$v.form.place.$dirty && !$v.form.conditions.maxLength"
              class="z-form-field__error"
            >
              <div class="caption">
                * dozwolona długość tekstu to 500 znaków
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          label="Miejsce"
          :required="true"
          :class="{'has-error': $v.form.place.$dirty && !$v.form.place.required}"
        >
          <template #input="{id}">
            <ZTextarea
              :id="id"
              v-model="form.place"
              rows="5"
            />
          </template>
          <template #error>
            <div
              v-if="$v.form.place.$dirty && !$v.form.place.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
            <div
              v-if="$v.form.place.$dirty && !$v.form.place.maxLength"
              class="z-form-field__error"
            >
              <div class="caption">
                * dozwolona długość tekstu to 500 znaków
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          label="Kiedy"
          :required="true"
          :class="{'has-error': $v.form.date.$dirty && !$v.form.date.required}"
        >
          <template #input>
            <ZDatePicker
              v-model="form.date"
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
          <template #error>
            <div
              v-if="$v.form.date.$dirty && !$v.form.date.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          label="Rodzaj wydarzenia"
          :required="true"
          :class="{'has-error': $v.form.event_type.$dirty && !$v.form.event_type.required}"
        >
          <template #input="{id}">
            <ZSelect
              :id="id"
              v-model="form.event_type"
              :options="categories.event_types.options"
              class="z-form-field__input"
            />
          </template>
          <template #error>
            <div
              v-if="$v.form.event_type.$dirty && !$v.form.event_type.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          label="Metodyka"
          :required="true"
          :class="{'has-error': $v.form.age_groups.$dirty && !$v.form.age_groups.required}"
        >
          <template #input="{id}">
            <ZSelect
              :id="id"
              v-model="form.age_groups"
              :multiple="true"
              size="5"
              :options="categories.age_groups.options"
              class="z-form-field__input"
            />
          </template>
          <template #error>
            <div
              v-if="$v.form.age_groups.$dirty && !$v.form.age_groups.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
        <ZFormField
          label="Województwo"
          :required="true"
          :class="{'has-error': $v.form.localization.$dirty && !$v.form.localization.required}"
        >
          <template #input="{id}">
            <ZSelect
              :id="id"
              v-model="form.localization"
              :options="categories.localizations.options"
              class="z-form-field__input"
            />
          </template>
          <template #error>
            <div
              v-if="$v.form.localization.$dirty && !$v.form.localization.required"
              class="z-form-field__error"
            >
              <div class="caption">
                * to pole jest wymagane
              </div>
            </div>
          </template>
        </ZFormField>
      </ZAccordionItem>
    </ZAccordion>
    <ZText
      class="caption"
      style="--text-margin: 4px 0 8px 0;"
    >
      Na poniższy adres e-mail wyślemy link służący weryfikacji wydarzenia.
    </ZText>
    <ZFormField
      v-model="form.to_confirm"
      type="mail"
      label="Mail"
      :required="true"
      :class="{'has-error': $v.form.to_confirm.$dirty && !$v.form.to_confirm.required}"
    >
      <template #error>
        <div
          v-if="$v.form.person.$dirty && !$v.form.person.required"
          class="z-form-field__error"
        >
          <div class="caption">
            * to pole jest wymagane
          </div>
        </div>
      </template>
    </ZFormField>
    <div
        v-if="$v.form.$error"
        class="new-event-form__error caption"
    >
      * formularz zawiera błędzy i nie może zostać wysłany
    </div>
  </ZForm>
</template>

<script>
import { disableBodyScroll, clearAllBodyScrollLocks } from 'body-scroll-lock'
import { validationMixin } from 'vuelidate'
import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
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
  mixins: [validationMixin],
  props: {
    categories: {
      type: Object,
      default: () => ({})
    }
  },
  data () {
    return {
      form: {
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
        age_groups: [],
        localization: '',
        to_confirm: ''
      }
    }
  },
  validations: {
    form: {
      person: {
        required
      },
      unit: {
        required
      },
      phone: {},
      mail: {
        required,
        email
      },
      title: {
        required
      },
      file: {
        required
      },
      description: {
        required,
        maxLength: maxLength(500)
      },
      conditions: {
        required,
        maxLength: maxLength(500)
      },
      place: {
        required,
        maxLength: maxLength(500)
      },
      date: {
        required,
      },
      event_type: {
        required,
      },
      age_groups: {
        required,
      },
      localization: {
        required,
      },
      to_confirm: {
        required,
        email
      }
    }
  },
  mounted () {
    this.$nextTick(() => {
      disableBodyScroll(this.$refs.scroll.$el)
    })
  },
  beforeDestroy () {
    clearAllBodyScrollLocks(this.$refs.scroll.$el)
  },
  methods: {
    submitHandler () {
      this.$v.$touch()
      if (this.$v.form.$invalid) {
        return
      }
      const formData = new FormData()
      formData.append('person', this.form.person)
      formData.append('unit', this.form.unit)
      formData.append('phone', this.form.phone)
      formData.append('mail', this.form.mail)
      formData.append('title', this.form.title)
      formData.append('web', this.form.web)
      formData.append('file', this.form.file)
      formData.append('description', this.form.description)
      formData.append('conditions', this.form.conditions)
      formData.append('place', this.form.place)
      formData.append('begin', this.form.date[0])
      formData.append('end', this.form.date[1])
      formData.append('event_type', this.form.event_type)
      formData.append('age_groups', this.form.age_groups)
      formData.append('localization', this.form.localization)
      formData.append('to_confirm', this.form.to_confirm)
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
      this.$emit('click:cancel')
    },
    uploadHandler (event) {
      const file = event.target.files[0]
      const img = new Image()
      img.addEventListener('load', (event) => {
        const width = event.path[0].width
        const height = event.path[0].height
        const invalid = [true, true]
        if (width >= 727 && width <= 1280) {
          invalid[0] = false
        }
        if (height >= 396 && height <= 720) {
          invalid[1] = false
        }
        if (!invalid.every(option => (!option))) {
          this.form.file = null
          this.$refs.file.value = ''
        }
      })
      img.src = URL.createObjectURL(file)
      this.form.file = file
      this.$v.form.file.$touch()
    }
  }
}
</script>

<style lang="scss">
.new-event-form {
  --text-margin: 0 0 8px 0;

  &__error {
    color: #e30613;
  }

  &__form {
    //height: 100%;
    //overflow-y: auto;
  }
}

.has-error {
  --input-border: 1px solid #e30613;
  --textarea-border: 1px solid #e30613;
  --select-border: 1px solid #e30613;
}
</style>
