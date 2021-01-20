export default function getCategories() {
  if (app.data.settings['sycho-ace.selected-categorization'] === 'none') return { none: 0 };
  else if (app.data.settings['sycho-ace.selected-categorization'] === 'vendor') return getVendors();

  return app.extensionCategories;
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
