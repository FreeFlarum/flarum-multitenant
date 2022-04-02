import isExtensionEnabled from 'flarum/admin/utils/isExtensionEnabled';

export default function getAvailabilityCategorizedExtensions() {
  let extensions = { enabled: [], disabled: [] };

  Object.keys(app.data.extensions).map((id) => {
    const category = isExtensionEnabled(id) ? 'enabled' : 'disabled';

    extensions[category].push(app.data.extensions[id]);
  });

  return extensions;
}
