import getCategories from './getCategories';

export default function getCategoryLabels() {
  let labels = {};
  const categories = getCategories();

  Object.keys(categories).map((category) => {
    if (app.data.settings['sycho-ace.selected-categorization'] === 'default')
      labels[category] = app.translator.trans(`core.admin.nav.categories.${category}`);
    else if (app.data.settings['sycho-ace.selected-categorization'] === 'none')
      labels[category] = app.translator.trans(`sycho-ace.admin.categories.none`);
    else labels[category] = category;
  });

  return labels;
}
