// Interim fix, remove after Flarum 1.2 availability, see https://github.com/flarum/core/pull/3193

/**
 * Strip HTML tags and quotes out of the given string, replacing them with
 * meaningful punctuation.
 */
export function getPlainContent(string: string): string {
  const html = string.replace(/(<\/p>|<br>)/g, '$1 &nbsp;').replace(/<img\b[^>]*>/gi, ' ');

  const element = new DOMParser().parseFromString(html, 'text/html').documentElement;

  getPlainContent.removeSelectors.forEach((selector) => {
    const el = element.querySelectorAll(selector);
    el.forEach((e) => {
      e.remove();
    });
  });

  return element.innerText.replace(/\s+/g, ' ').trim();
}

/**
 * An array of DOM selectors to remove when getting plain content.
 *
 * @type {Array}
 */
getPlainContent.removeSelectors = ['blockquote', 'script'];
