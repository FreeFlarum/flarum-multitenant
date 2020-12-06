import app from 'flarum/app';
import ImgurUploadSettingsModal from './components/ImgurUploadSettingsModal';

app.initializers.add('imgur-upload', () => {
	app.extensionSettings['matteocontrini-imgur-upload'] = () => app.modal.show(ImgurUploadSettingsModal);
});
