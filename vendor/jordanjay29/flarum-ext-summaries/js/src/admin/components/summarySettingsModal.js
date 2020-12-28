import SettingsModal from 'flarum/components/SettingsModal';

export default class SummarySettingsModal extends SettingsModal {
        className() {
            return 'SummarySettingsModal Modal--small';
        }

        title() {
            return 'Summaries Settings';
        }

        form() {
            return [
              <div className="Form-group">
                <label>Summaries Settings</label>
                <p>Summary excerpt length in characters (default is 200)</p>
                <input className="FormControl" bidi={this.setting('flarum-ext-summaries.excerpt_length')}/>
              </div>
            ];
        }
}
