import app from 'flarum/app';
import Component from 'flarum/common/Component';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import Button from 'flarum/common/components/Button';
import Tooltip from 'flarum/common/components/Tooltip';
import classList from "flarum/common/utils/classList";

export default class UploadButton extends Component {
    oninit(vnode) {
        super.oninit(vnode);

        this.isLoading = false;
        this.isSuccess = false;
        this.isError = false;
        this.isPasteListenerAttached = false;
    }

    oncreate(vnode) {
        super.oncreate(vnode);
    }

    onupdate(vnode) {
        super.onupdate(vnode);

        if (!this.isPasteListenerAttached && app.forum.attribute('imgur-upload.allow-paste') === '1') {
            this.isPasteListenerAttached = true;
            this.attrs.textArea.addEventListener('paste', this.paste.bind(this));
        }
    }

    view() {
        let buttonIcon;
        if (this.isSuccess) buttonIcon = 'fas fa-check green';
        else if (this.isError) buttonIcon = 'fas fa-times red';
        else if (!this.isLoading) buttonIcon = 'far fa-image';

        let label = '';
        if (this.isLoading) label = app.translator.trans('imgur-upload.forum.loading');
        else if (this.isSuccess) label = app.translator.trans('imgur-upload.forum.done');
        else if (this.isError) label = app.translator.trans('imgur-upload.forum.error');

        return <Tooltip text={app.translator.trans('imgur-upload.forum.upload')}>
            <Button
                className={classList([
                    'Button',
                    'hasIcon',
                    'imgur-upload-button',
                    label === '' && 'Button--icon',
                ])}
                icon={buttonIcon}
                onclick={this.buttonClicked.bind(this)}>
                {this.isLoading && <LoadingIndicator size="small" display="inline" />}
                <span className="Button-label">{label}</span>
                <form>
                    <input type="file" accept="image/*" onchange={this.formUpload.bind(this)}
                           disabled={this.isLoading || this.isSuccess || this.isError}/>
                </form>
            </Button>
        </Tooltip>
    }

    paste(e) {
        if (this.isLoading) return;

        if (e.clipboardData && e.clipboardData.items) {
            let item = e.clipboardData.items[0];

            if (!item.type.startsWith('image')) {
                return;
            }

            let file = item.getAsFile();
            this.upload(file);
        }
    }

    buttonClicked(e) {
        this.$('input').click();
    }

    formUpload(e) {
        const files = this.$('input').prop('files');

        if (files.length === 0) {
            return;
        }

        this.upload(files[0]);
    }

    upload(file) {
        this.isLoading = true;
        m.redraw();

        const formData = new FormData();
        formData.append('image', file);

        $.ajax({
            url: 'https://api.imgur.com/3/image',
            headers: {
                'Authorization': 'Client-ID ' + app.forum.attribute('imgur-upload.client-id')
            },
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: this.success.bind(this),
            error: this.error.bind(this)
        });
    }

    success(response) {
        this.$('input').val('');

        this.isLoading = false;
        this.isSuccess = true;
        m.redraw();

        let stringToInject = this.buildEmbedCode(response.data.link, response.data.width > 1024);

        this.attrs.editor.insertAtCursor(stringToInject);

        // After a bit, re-enable upload
        setTimeout(() => {
            this.isSuccess = false;
            m.redraw();
        }, 2000);
    }

    buildEmbedCode(imageUrl, isLarge) {
        let previewUrl = (isLarge ? this.previewUrl(imageUrl) : imageUrl);
        let embedType = app.forum.attribute('imgur-upload.embed-type');

        if (embedType === 'full-with-link') {
            return `[URL=${imageUrl}][IMG]${imageUrl}[/IMG][/URL]\n`;
        } else if (embedType === 'full-without-link') {
            return `[IMG]${imageUrl}[/IMG]\n`;
        } else if (embedType === 'preview-without-link') {
            return `[IMG]${previewUrl}[/IMG]\n`;
        } else {
            // Preview with link (default case)
            return `[URL=${imageUrl}][IMG]${previewUrl}[/IMG][/URL]\n`;
        }
    }

    previewUrl(url) {
        let extensionIndex = url.lastIndexOf('.');
        return url.slice(0, extensionIndex) + 'h' + url.slice(extensionIndex);
    }

    error(response) {
        $('#imgur-upload-form').val('');

        this.isLoading = false;
        this.isError = true;
        m.redraw();

        // Output the error to the console, for debugging purposes
        console.error(response);

        // After a bit, re-enable upload
        setTimeout(() => {
            this.isError = false;
            m.redraw();
        }, 2000);
    }
}
