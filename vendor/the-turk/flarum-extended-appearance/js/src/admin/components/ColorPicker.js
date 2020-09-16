import app from 'flarum/app';

import Component from 'flarum/Component';
import Pickr from '@simonwep/pickr/dist/pickr.es5.min';

const localePrefix = 'the-turk-extended-appearance.admin.';

export default class ColorPicker extends Component {
  view() {
    return m('div', {
      config: (element, isInitialized) => {
        if (isInitialized) return;

        const pickr = Pickr.create({
          el: element,
          theme: 'monolith',
          position: 'right-end',
          default: this.props.value,
          swatches: this.props.swatches,
          components: {
            // Main components
            preview: true,
            opacity: false,
            hue: true,
            // Input / output Options
            interaction: {
                input: true,
                cancel: true,
                save: true
            }
          },
          i18n: {
           'btn:save': app.translator.trans(localePrefix + 'pickr.save'),
           'btn:cancel': app.translator.trans(localePrefix + 'pickr.cancel')
          }
        });

        pickr.on('cancel', () => {
          this.props.onchange(
            pickr.getSelectedColor().toHEXA().toString()
          );

          pickr.hide();
        })

        pickr.on('change', (color) => {
            this.props.onchange(
              color.toHEXA().toString()
            );
        });

        pickr.on('save', (color) => {
            this.props.onsave(
              color.toHEXA().toString()
            );
        });
      },
    });
  }
}
