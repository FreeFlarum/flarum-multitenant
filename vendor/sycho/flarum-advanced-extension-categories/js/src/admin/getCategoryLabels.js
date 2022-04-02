import getCategories from './getCategories';

export default function getCategoryLabels() {
  let labels = {};
  const categories = getCategories();

  Object.keys(categories).map((category) => {
    switch (app.data.settings['sycho-ace.selected-categorization']) {
      case 'default':
        labels[category] = app.translator.trans(`core.admin.nav.categories.${category}`);
        break;

      case 'vendor':
        labels[category] = category;
        break;

      default:
        labels[category] = app.translator.trans(`sycho-ace.admin.categories.${category}`);
    }
  });

  return labels;
}
