import axios from 'axios'
import { content } from './content'

export const safe = {
  mixins: [content],

  data () {
    return {
      domain: 'safe',
      content: 'safes',
      data: null
    }
  },

  methods: {
    /**
     * Store a new resource.
     *
     * @param  {object} event
     * @return {void}
     */
    async storeResource (event) {
      const { data } = await this.form.post(this.api)

      this.$router.push({ name: 'safes.edit', params: { 'safes': data.data.id } })
    },

    /**
     * Show a resource.
     *
     * @param  {integer|string} resourceId
     * @return {void}
     */
    async showResource () {
      const { data } = await axios.get(this.api + this.$route.params.safes)
      this.resource = data
    },

    /**
     * Store a new resource.
     *
     * @param  {object} event
     * @return {void}
     */
    async fillResource (event) {
      const { data } = await axios.get(this.api + this.$route.params.safes + '/edit')

      this.form.keys().forEach(key => {
        this.form[key] = data.data[key]
      })

      this.loading = false
    },

    /**
     * Update a safe.
     *
     * @param  {object} event
     * @return {void}
     */
    async updateResource (event) {
      await this.form.patch(this.api + this.$route.params.safes)
    },
  }
}
