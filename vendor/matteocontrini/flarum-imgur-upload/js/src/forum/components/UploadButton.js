import Component from 'flarum/Component';
import icon from 'flarum/helpers/icon';
import LoadingIndicator from 'flarum/components/LoadingIndicator';

export default class UploadButton extends Component {
    oncreate(vnode) {
        super.oncreate(vnode);

        this.isLoading = false;
        this.isSuccess = false;
        this.isError = false;
        this.isPasteListenerAttached = false;
    }

    onupdate(vnode) {
        if (!this.isPasteListenerAttached) {
            this.isPasteListenerAttached = true;
            this.attrs.textArea.el.addEventListener('paste', this.paste.bind(this));
        }
    }
    
    view() {
        let attrs = {
            className: 'Button hasIcon imgur-upload-button',
            title: app.translator.trans('imgur-upload.forum.upload'),
            oncreate: (el) => {
                $(el.dom).tooltip();
            }
        };
        
        let buttonIcon;
        if (this.isLoading) buttonIcon = LoadingIndicator.component({ className: 'Button-icon' });
        else if (this.isSuccess) buttonIcon = icon('fas fa-check green', { className: 'Button-icon' });
        else if (this.isError) buttonIcon = icon('fas fa-times red', { className: 'Button-icon' });
        else buttonIcon = icon('far fa-image', { className: 'Button-icon' });
        
        let label = '';
        if (this.isLoading) label = app.translator.trans('imgur-upload.forum.loading');
        else if (this.isSuccess) label = app.translator.trans('imgur-upload.forum.done');
        else if (this.isError) label = app.translator.trans('imgur-upload.forum.error');
        
        // When there is no label, the component element should be shown as a square button
        if (label == '') {
            attrs.className += ' Button--icon';
        }
        
        return m('div', attrs, [
            buttonIcon,
                m('span', { className: 'Button-label' }, label),
                m('form#imgur-upload-form', [
                    m('input', {
                        type: 'file',
                        accept: 'image/*',
                        onchange: this.formUpload.bind(this),
                        // disable button while doing things
                        disabled: this.isLoading || this.isSuccess || this.isError
                    })
                ])
            ]
        );
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
    
    formUpload(e) {
        let file = $(e.target)[0].files[0];
        this.upload(file);
    }
    
    upload(file) {
        $(this.element).tooltip('hide'); // force removal of the tooltip
        this.isLoading = true;
        m.redraw();

        let formData = new FormData();
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
        $('#imgur-upload-form input').val('');
        
        this.isLoading = false;
        this.isSuccess = true;
        m.redraw();

        let stringToInject = this.buildEmbedCode(response.data.link, response.data.width > 1024);

        this.attrs.textArea.insertAtCursor(stringToInject);

        // After a bit, re-enable upload
        setTimeout(() => {
            this.isSuccess = false;
            m.redraw();
        }, 2000);
    }

    buildEmbedCode(imageUrl, isLarge) {
        let previewUrl = (isLarge ? this.previewUrl(imageUrl) : imageUrl);
        let embedType = app.forum.attribute('imgur-upload.embed-type');

        if (embedType == 'full-with-link') {
            return `[URL=${imageUrl}][IMG]${imageUrl}[/IMG][/URL]\n`;
        }
        else if (embedType == 'full-without-link') {
            return `[IMG]${imageUrl}[/IMG]\n`;
        }
        else if (embedType == 'preview-without-link') {
            return `[IMG]${previewUrl}[/IMG]\n`;
        }
        else {
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
