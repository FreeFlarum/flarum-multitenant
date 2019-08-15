import app from 'flarum/app';
import ImgurUploadSettingsModal from './components/ImgurUploadSettingsModal';

app.initializers.add('imgur-upload', () => {
	// https://discuss.flarum.org/d/5083-getting-settingsmodal-to-appear
	app.extensionSettings['matteocontrini-imgur-upload'] = () => app.modal.show(new ImgurUploadSettingsModal());
});
