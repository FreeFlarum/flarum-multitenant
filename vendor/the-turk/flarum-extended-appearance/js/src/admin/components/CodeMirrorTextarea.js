import app from 'flarum/app';

import Component from 'flarum/Component';
import CodeMirror from 'codemirror';

import 'codemirror/mode/css/css';
import 'codemirror/mode/htmlmixed/htmlmixed';
import 'codemirror/addon/display/autorefresh';

// shout out to my man Clark Winkelmann
// (flarum-ext-scratchpad) CodeMirrorTextarea.js
// https://git.io/JfRLZ
export default class CodeMirrorTextarea extends Component {
  view() {
    return m('div', {
      config: (element, isInitialized) => {
        if (isInitialized) return;

        const document = CodeMirror(element, {
          value: this.props.value || '',
          indentUnit: 4,
          theme: app.forum.attribute('scratchpadTheme') || app.forum.attribute('appearanceCodeTheme'),
          autoRefresh: true,
          lineNumbers: true,
          mode: this.props.mode,
        }).getDoc();

        document.on('change', () => {
          this.props.onchange(document.getValue());
        });
      },
    });
  }
}
