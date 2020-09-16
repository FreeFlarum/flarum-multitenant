import app from 'flarum/app';
import { extend, override } from 'flarum/extend';
import updateColors from './utils/updateColors';
import saveSettings from 'flarum/utils/saveSettings';

import CodeMirrorTextarea from './components/CodeMirrorTextarea';
import ColorPicker from './components/ColorPicker';

import AppearancePage from 'flarum/components/AppearancePage';
import EditCustomCssModal from './components/modals/EditCustomCssModal';
import EditCustomHeaderModal from './components/modals/EditCustomHeaderModal';
import EditCustomFooterModal from './components/modals/EditCustomFooterModal';
import UploadImageButton from 'flarum/components/UploadImageButton';
import Button from 'flarum/components/Button';
import Switch from 'flarum/components/Switch';
import Select from 'flarum/components/Select';

const localePrefix = 'the-turk-extended-appearance.admin.';

// this regex will be used to test hex codes
// (flarum/core) AppearancePage.js
// https://git.io/JfRIx
const hex = /^#[0-9a-f]{3}([0-9a-f]{3})?$/i;

// shout out to my man Clark Winkelmann
// (flarum-ext-scratchpad) CodeMirrorSettingsModal.js
// https://git.io/JfRI0
const THEMES = [
  '3024-day', 'base16-dark', 'darcula', 'hopscotch',
  'material', 'monokai', 'panda-syntax', 'shadowfox',
  'twilight', '3024-night', 'base16-light', 'duotone-dark',
  'icecoder', 'material-darker', 'moxer', 'paraiso-dark',
  'solarized', 'vibrant-ink', 'abcdef', 'bespin',
  'duotone-light', 'idea', 'material-ocean', 'neat',
  'paraiso-light', 'ssms', 'xq-dark', 'ambiance',
  'blackboard', 'eclipse', 'isotope', 'material-palenight',
  'neo', 'pastel-on-dark', 'the-matrix', 'xq-light',
  'ambiance-mobile', 'cobalt', 'elegant', 'lesser-dark',
  'mbo', 'night', 'railscasts', 'tomorrow-night-bright',
  'yeti', 'ayu-dark', 'colorforth', 'erlang-dark',
  'liquibyte', 'mdn-like', 'nord', 'rubyblue',
  'tomorrow-night-eighties', 'yonce', 'ayu-mirage', 'darcula',
  'gruvbox-dark', 'lucario', 'midnight', 'oceanic-next',
  'seti', 'ttcn', 'zenburn'
];

function isScratchpadEnabled() {
  const enabled = JSON.parse(app.data.settings.extensions_enabled);
  return enabled.indexOf('clarkwinkelmann-scratchpad') !== -1;
}

app.initializers.add('the-turk/extended-appearance', () => {
  var updateNano = function (
    isPrimaryColor,
    isSecondaryColor,
    isDarkMode,
    isRightSidebar,
    isColoredHeader,
    value
  ) {
    if (isRightSidebar) {
      const rightSidebar = isRightSidebar ? value : this.rightSidebar();

      if (rightSidebar) {
        this.$('.nanoFlarum-sidebar').css({
          'right': '0',
          'left': 'auto'
        });
        this.$('.nanoFlarum-content').css({
          'margin-right': '50px',
          'margin-left': '0',
          'padding-right': '0',
          'padding-left': '5px'
        });
      } else {
        this.$('.nanoFlarum-sidebar').css({
          'left': '0',
          'right': 'auto'
        });
        this.$('.nanoFlarum-content').css({
          'margin-left': '50px',
          'margin-right': '0',
          'padding-left': '0',
          'padding-right': '5px'
        });
      }

      this.rightSidebar(value);
    } else {
      const coloredHeader = isColoredHeader ? value : this.coloredHeader();

      const colors = updateColors(
        isPrimaryColor ? (value || this.primaryColorForPickr()) : this.primaryColorForPickr(),
        isSecondaryColor ? (value || this.secondaryColorForPickr()) : this.secondaryColorForPickr(),
        isDarkMode ? value : this.darkMode(),
        coloredHeader
      );

      this.$('.nanoFlarum-container').css(
        'border-color', '#' + colors.controlBg
      );
      this.$('.nanoFlarum-header').css({
        'border-bottom-color': '#' + colors.controlBg,
        'background-color': '#' + colors.headerBg
      });
      this.$('.nanoFlarum-hero').css(
        'background-color', '#' + colors.heroBg
      );
      this.$('.nanoFlarum-hero--text').css(
        'background-color', '#' + colors.heroColor
      );
      this.$('.nanoFlarum-mainContent').css(
        'background-color', '#' + colors.bodyBg
      );
      this.$('.nanoFlarum-button').css(
        'background-color', '#' + colors.primaryColor
      );
      this.$('.nanoFlarum-tag').css(
        'background-color', '#' + colors.mutedColor
      );
      this.$('.nanoFlarum-tag.selected').css(
        'background-color', '#' + colors.linkColor
      );
      this.$('.nanoFlarum-button-order').css(
        'background-color', '#' + colors.controlBg
      );
      this.$('.nanoFlarum-button-refresh').css(
        'background-color', '#' + colors.controlBg
      );
      this.$('.nanoFlarum-content-discussion--highlighted').css({
        'background-color': '#' + colors.highlightedDiscussion,
        'color': '#' + colors.controlColor
      });
      this.$('.nanoFlarum-content-discussion--title').css(
        'background-color', '#' + colors.discussionTitleColor
      );
      this.$('.nanoFlarum-content-discussion--info').css(
        'background-color', '#' + colors.mutedMoreColor
      );

      if (coloredHeader) {
        this.$('.nanoFlarum-logo').css(
          'background-color', '#' + colors.headerColor
        );
        this.$('.nanoFlarum-notification').css({
          'color': '#' + colors.headerControlColor,
          'background-color': '#' + colors.headerControlBg
        });
      } else {
        this.$('.nanoFlarum-logo').css(
          'background-color', '#' + colors.linkColor
        );
        this.$('.nanoFlarum-notification').css({
          'color': '#' + colors.controlColor,
          'background-color': '#' + colors.notificationDarkerBg
        });
      }

      if (isPrimaryColor) this.primaryColorForPickr(value);
      if (isSecondaryColor) this.secondaryColorForPickr(value);
      if (isDarkMode) this.darkMode(value);
      if (isColoredHeader) this.coloredHeader(value);
    }
  }

  var changedInput = function (isPrimaryColor, value) {
    if (isPrimaryColor) this.primaryColor(value);
    if (!isPrimaryColor) this.secondaryColor(value);

    if (hex.test(value)) {
      updateNano.bind(this, isPrimaryColor, !isPrimaryColor, false, false, false, value)();
    }
  }

  extend(AppearancePage.prototype, 'init', function () {
    this.primaryColorForPickr = this.primaryColor;
    this.secondaryColorForPickr = this.secondaryColor;
    this.rightSidebar = m.prop(app.data.settings.exap_theme_right_sidebar === '1');
    this.codeMirrorTheme = m.prop(app.data.settings.exap_theme_code_mirror_theme);
  });

  override(AppearancePage.prototype, 'view', function () {
    const themeOptions = {
      auto: app.translator.trans(localePrefix + 'codeMirror.autoTheme'),
    };

    THEMES.forEach(theme => {
      themeOptions[theme] = theme;
    });

    return (
      <div className="AppearancePage">
        <div className="container">
          <form onsubmit={this.onsubmit.bind(this)}>
            <fieldset className="AppearancePage-colors">
              <legend>{app.translator.trans('core.admin.appearance.colors_heading')}</legend>
              <div className="helpText">{app.translator.trans('core.admin.appearance.colors_text')}</div>
              <div class="AppearancePage-extended-appearance-main-container">
                <div class="AppearancePage-extended-appearance-container">
                  <div className="nanoFlarum">
                     <div class="nanoFlarum-container">
                        <div class="nanoFlarum-header">
                           <div class="nanoFlarum-logo"></div>
                           <div class="nanoFlarum-notification">
                              <i class="icon fas fa-bell fa-xs Button-icon"></i>
                           </div>
                        </div>
                        <div class="nanoFlarum-hero">
                           <div class="nanoFlarum-hero--text"></div>
                        </div>
                        <div class="nanoFlarum-mainContent">
                           <div class="nanoFlarum-sidebar">
                              <div class="nanoFlarum-button"></div>
                              <div class="nanoFlarum-tag selected"></div>
                              <div class="nanoFlarum-tag"></div>
                              <div class="nanoFlarum-tag"></div>
                           </div>
                           <div class="nanoFlarum-content">
                              <div class="nanoFlarum-content-buttons">
                                 <div class="nanoFlarum-button-order"></div>
                                 <div class="nanoFlarum-button-refresh"></div>
                              </div>
                              <div class="nanoFlarum-content-discussions-container">
                                <div class="nanoFlarum-content-discussion">
                                   <span class="nanoFlarum-content-discussion--title"></span>
                                   <span class="nanoFlarum-content-discussion--info"></span>
                                </div>
                                <div class="nanoFlarum-content-discussion--highlighted">
                                  <div class="nanoFlarum-content-discussion">
                                     <span class="nanoFlarum-content-discussion--title"></span>
                                     <span class="nanoFlarum-content-discussion--info"></span>
                                  </div>
                                  <div class="nanoFlarum-content-discussion-controls">
                                     <i class="icon fas fa-ellipsis-h Button-icon"></i>
                                  </div>
                                </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="AppearancePage-pickers">
                    <div class="AppearancePage-picker-container">
                        {ColorPicker.component({
                          value: this.primaryColorForPickr(),
                          onchange: updateNano.bind(this, true, false, false, false, false),
                          onsave: color => this.primaryColor(color),
                          swatches: [
                            '#536F90', '#E2571A', '#991D1D', '#A9216B',
                            '#683309', '#487549', '#A6A7A3'
                          ]
                        })}
                    </div>
                    <div class="AppearancePage-picker-container">
                        {ColorPicker.component({
                          value: this.secondaryColorForPickr(),
                          onchange: updateNano.bind(this, false, true, false, false, false),
                          onsave: color => this.secondaryColor(color),
                          swatches: [
                            '#536F90', '#EBEFF3', '#27363B', '#ED1B4C',
                            '#0F1217', '#ABBA82', '#EAE9E4'
                          ]
                        })}
                    </div>
                  </div>
              </div>
              <div class="AppearancePage-switch-container">
                  {Switch.component({
                    state: this.darkMode(),
                    children: app.translator.trans('core.admin.appearance.dark_mode_label'),
                    onchange: updateNano.bind(this, false, false, true, false, false)
                  })}
                  {Switch.component({
                    state: this.coloredHeader(),
                    children: app.translator.trans('core.admin.appearance.colored_header_label'),
                    onchange: updateNano.bind(this, false, false, false, false, true)
                  })}
                  {Switch.component({
                    state: this.rightSidebar(),
                    children: app.translator.trans(localePrefix + 'rightSidebar'),
                    onchange: updateNano.bind(this, false, false, false, true, false)
                  })}
                </div>
              </div>
            </fieldset>

            <fieldset>
              <legend>
                {app.translator.trans(localePrefix + 'codeMirror.title')}
              </legend>
              {
                isScratchpadEnabled() ?
                  <div className="helpText">
                    {app.translator.trans(localePrefix + 'codeMirror.scratchpad')}
                  </div>
                : [
                    <div className="helpText">
                      {app.translator.trans(localePrefix + 'codeMirror.helpText', {
                        a: <a href="https://codemirror.net/demo/theme.html" target="_blank" />
                      })}
                    </div>,
                    m('.selectCodeMirrorTheme',
                      Select.component({
                        value: this.codeMirrorTheme() || 'auto',
                        onchange: this.codeMirrorTheme,
                        options: themeOptions,
                      })
                    )
                  ]
              }
              {Button.component({
                className: 'Button Button--primary',
                type: 'submit',
                children: app.translator.trans('core.admin.appearance.submit_button'),
                loading: this.loading,
              })}
            </fieldset>
          </form>

          <fieldset>
            <legend>{app.translator.trans('core.admin.appearance.logo_heading')}</legend>
            <div className="helpText">{app.translator.trans('core.admin.appearance.logo_text')}</div>
            <UploadImageButton name="logo" />
          </fieldset>

          <fieldset>
            <legend>{app.translator.trans('core.admin.appearance.favicon_heading')}</legend>
            <div className="helpText">{app.translator.trans('core.admin.appearance.favicon_text')}</div>
            <UploadImageButton name="favicon" />
          </fieldset>

          <fieldset>
            <legend>{app.translator.trans('core.admin.appearance.custom_header_heading')}</legend>
            <div className="helpText">{app.translator.trans('core.admin.appearance.custom_header_text')}</div>
            {Button.component({
              className: 'Button',
              children: app.translator.trans('core.admin.appearance.edit_header_button'),
              onclick: () => app.modal.show(new EditCustomHeaderModal()),
            })}
          </fieldset>

          <fieldset>
            <legend>{app.translator.trans('core.admin.appearance.custom_footer_heading')}</legend>
            <div className="helpText">{app.translator.trans('core.admin.appearance.custom_footer_text')}</div>
            {Button.component({
              className: 'Button',
              children: app.translator.trans('core.admin.appearance.edit_footer_button'),
              onclick: () => app.modal.show(new EditCustomFooterModal()),
            })}
          </fieldset>

          <fieldset>
            <legend>{app.translator.trans('core.admin.appearance.custom_styles_heading')}</legend>
            <div className="helpText">{app.translator.trans('core.admin.appearance.custom_styles_text')}</div>
            {Button.component({
              className: 'Button',
              children: app.translator.trans('core.admin.appearance.edit_css_button'),
              onclick: () => app.modal.show(new EditCustomCssModal()),
            })}
          </fieldset>
        </div>
      </div>
    );
  });

  override(AppearancePage.prototype, 'onsubmit', function (o, e) {
    e.preventDefault();

    if (!hex.test(this.primaryColor()) || !hex.test(this.secondaryColor())) {
      alert(app.translator.trans('core.admin.appearance.enter_hex_message'));
      return;
    }

    this.loading = true;

    saveSettings({
      theme_primary_color: this.primaryColor(),
      theme_secondary_color: this.secondaryColor(),
      theme_dark_mode: this.darkMode(),
      exap_theme_right_sidebar: this.rightSidebar(),
      exap_theme_code_mirror_theme: this.codeMirrorTheme(),
      theme_colored_header: this.coloredHeader(),
    }).then(() => window.location.reload());
  });
});
