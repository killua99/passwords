<template>
  <div class="form-group row">
    <label class="col-md-3 col-form-label text-md-right"><slot></slot></label>
    <div class="col-md-7">
      <vue-tags-input
        v-if="!loading"
        v-model="tag"
        :tags="tags"
        :autocomplete-items="autocompleteItems"
        :placeholder="$t(placeholder)"
        @tags-changed="update"
        :class="{ 'is-invalid': form.errors.has(name) }"
        :name="name"
      />
      <component-loading v-else></component-loading>
      <div class="help-block invalid-feedback d-block" v-if="form.errors.has(name)" v-html="form.errors.get(name)"/>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import VueTagsInput from '@johmun/vue-tags-input'

export default {
  name: 'CTags',

  components: {
    VueTagsInput,
  },

  props: {
    form: { type: Object },
    name: { type: String },
    source: { type: String },
    placeholder: { type: String }
  },

  data () {
    return {
      tag: '',
      tags: [],
      autocompleteItems: [],
      debounce: null,
      loading: true
    }
  },

  async created () {
    await this.fillTags()
    this.loading = false
  },

  methods: {
    update (newTags) {
      this.autocompleteItems = []
      this.tags = newTags
      this.form[this.name] = newTags.map(t => {
        return t.text
      })
    },

    initItems () {
      if (this.tag.length === 0) return
      const url = `${this.source}search?q=${this.tag}`

      clearTimeout(this.debounce)
      this.debounce = setTimeout(() => {
        axios.get(url).then(response => {
          this.autocompleteItems = response.data.data.map(c => {
            Array.isArray(this.form[this.name])
              ? this.form[this.name].push(c.name)
              : this.form[this.name] = [c.name]
            return { text: c.name, id: c.id }
          })
        }).catch((e) => console.warn(e))
      }, 300)
    },

    async fillTags () {
      let form = []
      for (var i = this.form[this.name].length - 1; i >= 0; i--) {
        this.tags.push({ 'text': this.form[this.name][i].name })
        form.push(this.form[this.name][i].name)
      }
      this.form[this.name] = form
    }
  },

  watch: {
    'tag': 'initItems',
  },
}
</script>
