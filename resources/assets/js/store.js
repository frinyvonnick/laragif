import set from 'lodash/set'

export default {
  debug: true,
  state: {
    gifs: [],
    user: {},
    search: '',
    endpoint: '',
    offset: 0,
  },
  set(key, value) {
    set(this.state, key, value)
  },
}
