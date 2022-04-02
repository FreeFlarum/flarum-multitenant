import getCategorizedExtensions from 'flarum/admin/utils/getCategorizedExtensions';
import getAlphabeticallyOrderedExtensions from './utils/getAlphabeticallyOrderedExtensions';
import getVendorCategorizedExtensions from './utils/getVendorCategorizedExtensions';
import getAvailabilityCategorizedExtensions from './utils/getAvailabilityCategorizedExtensions';

export default function overrideGetCategorizedExtensions() {
  switch (app.data.settings['sycho-ace.selected-categorization']) {
    case 'none':
      return getAlphabeticallyOrderedExtensions();

    case 'vendor':
      return getVendorCategorizedExtensions();

    case 'availability':
      return getAvailabilityCategorizedExtensions();

    default:
      return getCategorizedExtensions();
  }
}
