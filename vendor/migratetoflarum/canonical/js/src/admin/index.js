import app from 'flarum/app';
import ExtensionPage from './components/ExtensionPage';

app.initializers.add('migratetoflarum-canonical', app => {
    app.extensionData
        .for('migratetoflarum-canonical')
        .registerPage(ExtensionPage);
});
