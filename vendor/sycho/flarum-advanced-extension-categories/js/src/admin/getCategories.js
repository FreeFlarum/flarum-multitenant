export default function getCategories() {
  switch (app.data.settings['sycho-ace.selected-categorization']) {
    case 'none':
      return { none: 0 };

    case 'vendor':
      return getVendors();

    case 'availability':
      return { enabled: 10, disabled: 0 };

    default:
      return app.extensionCategories;
  }
}

export function getVendors() {
  let vendors = {};
  let vendorsArray = [];

  Object.keys(app.data.extensions).map((id) => {
    vendorsArray.push(id.split('-')[0]);
  });

  vendorsArray.sort((a, b) => {
    return a === 'flarum' ? -1 : a > b ? 1 : a === b ? 0 : -1;
  });

  let k = vendorsArray.length * 10;
  vendorsArray.forEach((v) => (vendors[v] = k -= 10));

  if (vendors.flarum) vendors.flarum = 5000;

  return vendors;
}
