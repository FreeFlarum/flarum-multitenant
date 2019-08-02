import app from 'flarum/app';

import TwitterSettingsModal from './components/TwitterSettingsModal';

app.initializers.add('flarum-auth-twitter', () => {
  app.extensionSettings['flarum-auth-twitter'] = () => app.modal.show(new TwitterSettingsModal());
});
