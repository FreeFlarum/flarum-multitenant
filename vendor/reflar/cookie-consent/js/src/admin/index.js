import app from 'flarum/app';
import CookieConsentSettingsModal from './components/CookieConsentSettingsModal';

app.initializers.add('reflar-cookie-consent', () => {
    app.extensionSettings['reflar-cookie-consent'] = () => app.modal.show(new CookieConsentSettingsModal());
});
