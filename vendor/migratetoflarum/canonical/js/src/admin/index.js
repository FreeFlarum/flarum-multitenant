import app from 'flarum/app';
import CanonicalSettingsModal from './components/CanonicalSettingsModal';

app.initializers.add('migratetoflarum-canonical', app => {
    app.extensionSettings['migratetoflarum-canonical'] = () => app.modal.show(new CanonicalSettingsModal());
});
