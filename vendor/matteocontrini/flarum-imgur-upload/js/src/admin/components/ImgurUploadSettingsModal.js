import SettingsModal from 'flarum/components/SettingsModal';

export default class ImgurUploadSettingsModal extends SettingsModal {
	className() {
		return 'ImgurUploadSettingsModal Modal--small';
	}

	title() {
		return app.translator.trans('imgur-upload.admin.settings.title');
	}

	form() {
		return [
			<div className="Form-group">
				<label>Imgur Client ID</label>
				<input className="FormControl" bidi={this.setting('imgur-upload.client-id')}/>
			</div>
		];
	}
}
