import GoogleSettingsModal from './components/GoogleSettingsModal';

app.initializers.add('saleksin-auth-google', () => {
  app.extensionSettings['saleksin-auth-google'] = () => app.modal.show(new GoogleSettingsModal());
});
