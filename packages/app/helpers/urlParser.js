export default function (url) {
  const regex = /https?:\/\/zhp\.pl|https?:\/\/work\.zhp\.pl/gm // https?://zhp.pl, https?://work.zhp.pl
  return /wp-content/gm.test(url)
    ? url
    : url.replace(regex, '')
}
