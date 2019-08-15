import { extend } from 'flarum/extend';
import TextEditor from 'flarum/components/TextEditor';
import UploadButton from './components/UploadButton';

app.initializers.add('imgur-upload', function() {
	extend(TextEditor.prototype, 'controlItems', function(items) {
		items.add('imgur-upload', <UploadButton textArea={this} />);
	});
});
