export default function getAlphabeticallyOrderedExtensions() {
  let extensions = {};

  extensions.none = Object.values(app.data.extensions);

  return extensions;
}
