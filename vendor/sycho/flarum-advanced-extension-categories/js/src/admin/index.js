import { override, extend } from 'flarum/common/extend';
import AdminNav from 'flarum/admin/components/AdminNav';
import ExtensionLinkButton from 'flarum/admin/components/ExtensionLinkButton';
import ExtensionsWidget from 'flarum/admin/components/ExtensionsWidget';
import LoadingModal from 'flarum/admin/components/LoadingModal';
import ItemList from 'flarum/common/utils/ItemList';
import Dropdown from 'flarum/common/components/Dropdown';
import Button from 'flarum/common/components/Button';
import icon from 'flarum/common/helpers/icon';
import saveSettings from 'flarum/admin/utils/saveSettings';
import overrideGetCategorizedExtensions from './overrideGetCategorizedExtensions';
import getCategories from './getCategories';
import getCategoryLabels from './getCategoryLabels';

app.initializers.add(
  'sycho-advanced-extension-categories',
  (app) => {
    const categorizationOptions = {
      default: app.translator.trans('sycho-ace.admin.category_selection.options.default'),
      vendor: app.translator.trans('sycho-ace.admin.category_selection.options.vendor'),
      availability: app.translator.trans('sycho-ace.admin.category_selection.options.availability'),
      none: app.translator.trans('sycho-ace.admin.category_selection.options.none'),
    };

    app.extensionData.for('sycho-advanced-extension-categories').registerSetting(function () {
      const selectbox = this.buildSettingComponent({
        setting: 'sycho-ace.selected-categorization',
        label: app.translator.trans('sycho-ace.admin.category_selection.label'),
        type: 'select',
        options: categorizationOptions,
        default: 'default',
      });

      const originalSaveSettings = this.saveSettings;
      this.saveSettings = function (e) {
        originalSaveSettings.call(this, e);
        app.modal.show(LoadingModal);
        window.location.reload();
      };

      return selectbox;
    });

    const saveCategorization = (value) => {
      saveSettings({
        'sycho-ace.selected-categorization': value,
      }).then(() => window.location.reload());

      app.modal.show(LoadingModal);
    };

    app.extensionCategories = getCategories();
    app.categorizedExtensions = overrideGetCategorizedExtensions();
    app.categoryLabels = getCategoryLabels();

    ExtensionsWidget.prototype.controlItems = function () {
      const items = new ItemList();

      const selectedCategorization = app.data.settings['sycho-ace.selected-categorization'] ?? 'default';

      items.add(
        'categorization',
        <div className="ExtensionsWidget-control-item">
          <Dropdown buttonClassName="Button" label={app.translator.trans('sycho-ace.admin.category_selection.label')}>
            {Object.keys(categorizationOptions).map((key) => (
              <Button
                icon={selectedCategorization === key ? 'fas fa-check' : true}
                active={selectedCategorization === key}
                onclick={() => saveCategorization(key)}
              >
                {categorizationOptions[key]}
              </Button>
            ))}
          </Dropdown>
        </div>
      );

      return items;
    };

    override(ExtensionsWidget.prototype, 'oninit', function () {
      this.categorizedExtensions = app.categorizedExtensions;
    });

    override(ExtensionsWidget.prototype, 'content', function (original) {
      return [
        <div className="ExtensionsWidget-list-heading">
          <h2 className="ExtensionsWidget-list-name">
            <span className="ExtensionsWidget-list-icon">{icon('fas fa-puzzle-piece')}</span>
            <span className="ExtensionsWidget-list-title">{app.translator.trans('sycho-ace.admin.extensions')}</span>
          </h2>
          <div className="ExtensionsWidget-list-controls">{this.controlItems().toArray()}</div>
        </div>,
        original(),
      ];
    });

    extend(ExtensionsWidget.prototype, 'extensionCategory', function (vnode, category) {
      vnode.children[0].text = app.categoryLabels[category];
    });

    override(AdminNav.prototype, 'extensionItems', function () {
      const items = new ItemList();

      Object.keys(app.categorizedExtensions).map((category) => {
        if (!this.query()) {
          items.add(
            `category-${category}`,
            <h4 className="ExtensionListTitle">{app.categoryLabels[category]}</h4>,
            app.extensionCategories[category]
          );
        }

        app.categorizedExtensions[category].map((extension) => {
          const query = this.query().toUpperCase();
          const title = extension.extra['flarum-extension'].title;

          if (!query || title.toUpperCase().includes(query) || extension.description.toUpperCase().includes(query)) {
            items.add(
              `extension-${extension.id}`,
              <ExtensionLinkButton
                href={app.route('extension', { id: extension.id })}
                extensionId={extension.id}
                className="ExtensionNavButton"
                title={extension.description}
              >
                {title}
              </ExtensionLinkButton>,
              app.extensionCategories[category]
            );
          }
        });
      });

      return items;
    });
  },
  -999
);
