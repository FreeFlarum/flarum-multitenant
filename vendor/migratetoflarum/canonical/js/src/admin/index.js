import app from 'flarum/admin/app';
import ExtensionPage from './components/ExtensionPage';

app.initializers.add('migratetoflarum-canonical', app => {
    app.extensionData
        .for('migratetoflarum-canonical')
        .registerPage(ExtensionPage);
});
