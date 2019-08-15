import { extend } from 'flarum/extend';
import app from 'flarum/app';
import TwoFactorSettingsModal from './components/TwoFactorSettingsModal';

app.initializers.add('Reflar-Twofactor', app => {
  app.extensionSettings['reflar-twofactor'] = () => app.modal.show(new TwoFactorSettingsModal());
});
