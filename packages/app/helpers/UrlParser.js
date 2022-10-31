export default class UrlParser {
  constructor(store) {
    this.$store = store;
  }

  parse(url) {
    if (this.$store == undefined){
      return url;
    }
    const internalDomains = this.$store.getters['theme/domains']
      .map((domain) => 'https?:\/\/' + domain.replace('.', '\.')).join('|');
    const regex = new RegExp(internalDomains);
    return /wp-content/gm.test(url)
      ? url
      : url.replace(regex, '')
  }
}
