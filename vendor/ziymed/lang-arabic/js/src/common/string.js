/**
 * Create a slug out of the given string. Non-alphanumeric characters are
 * converted to hyphens.
 *
 * @param {String} string
 * @return {String}
 */
export function slug(string) {
  return string.toLowerCase()
    .replace(/\s+/gi, '-')
    .replace(/-+/g, '-')
    .replace(/-$|^-/g, '');
}