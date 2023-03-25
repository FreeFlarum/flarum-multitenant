// JavaScript way to check if the path starts with http:// or https://
// We're using a similar thing on the ConfigureTextFormatter.php
export default function urlChecker(url) {
  const regex = new RegExp('^(http|https)://', 'i');

  if (url.match(regex)) return true;

  return false;
}
