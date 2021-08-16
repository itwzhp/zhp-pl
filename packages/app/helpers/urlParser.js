export default function (url) {
  const regex = window && `${window.location.protocol}//${window.location.host}`
  return /wp-content/gm.test(url)
    ? url
    : url.replace(regex, '')
}
