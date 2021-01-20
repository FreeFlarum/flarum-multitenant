import getCategorizedExtensions from 'flarum/admin/utils/getCategorizedExtensions';
import getAlphabeticallyOrderedExtensions from './utils/getAlphabeticallyOrderedExtensions';
import getVendorCategorizedExtensions from './utils/getVendorCategorizedExtensions';

export default function overrideGetCategorizedExtensions() {
  if (app.data.settings['sycho-ace.selected-categorization'] === 'none') return getAlphabeticallyOrderedExtensions();
  else if (app.data.settings['sycho-ace.selected-categorization'] === 'vendor') return getVendorCategorizedExtensions();

  return getCategorizedExtensions();
}
