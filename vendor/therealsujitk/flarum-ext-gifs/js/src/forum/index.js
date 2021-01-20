import {extend} from 'flarum/extend';
import app from 'flarum/app';
import TextEditor from 'flarum/components/TextEditor';
import SearchGIFModal from './components/SearchGIFModal';

app.initializers.add('therealsujitk/flarum-ext-gifs', () => {
    extend(TextEditor.prototype, 'toolbarItems', function (items) {
        items.add('therealsujitk-gifs',
            m('button', {
                type: 'buton',
                class: 'Button Button--icon Button--link hasIcon',
                title: app.translator.trans('therealsujitk.forum.gifs.label'),
                onclick: () => app.modal.show(SearchGIFModal, { textArea: this.attrs.composer.editor })
            }, [
                m('svg', {
                    class: 'fas fa-this-icon-does-not-exist',
                    xmlns: 'http://www.w3.org/2000/svg',
                    xlink: 'http://www.w3.org/1999/xlink',
                    width: '16pt',
                    height: '7pt',
                    viewBox: '0 0 16 7',
                    version: '1.1'
                }, [
                    m('g', { id: 'surface1' }, [
                        m('path[fill = currentColor]', {
                            d: 'M 0.78125 7.042969 C 0.496094 6.933594 0.265625 6.738281 0.132812 6.480469 L 0 6.234375 L 0 0.875 L 0.132812 0.625 C 0.277344 0.355469 0.558594 0.128906 0.847656 0.0429688 C 0.957031 0.015625 1.71875 0 2.917969 0.0078125 L 4.808594 0.0234375 L 5.050781 0.15625 C 5.21875 0.246094 5.332031 0.355469 5.425781 0.511719 C 5.597656 0.800781 5.648438 0.992188 5.648438 1.410156 L 5.648438 1.753906 L 1.65625 1.753906 L 1.65625 5.355469 L 3.96875 5.355469 L 3.96875 3.554688 L 5.648438 3.554688 L 5.648438 4.800781 C 5.648438 5.484375 5.628906 6.117188 5.605469 6.207031 C 5.523438 6.527344 5.308594 6.808594 5.050781 6.953125 L 4.808594 7.085938 L 2.878906 7.09375 C 1.339844 7.105469 0.917969 7.09375 0.78125 7.042969 Z M 0.78125 7.042969 '
                        }),
                        m('path[fill = currentColor]', {
                            d: 'M 7.371094 3.554688 L 7.371094 0 L 9.050781 0 L 9.050781 7.109375 L 7.371094 7.109375 Z M 7.371094 3.554688 '
                        }),
                        m('path[fill = currentColor]', {
                            d: 'M 10.773438 3.554688 L 10.773438 0 L 15.855469 0 L 15.855469 1.753906 L 12.453125 1.753906 L 12.453125 2.988281 L 14.722656 2.988281 L 14.722656 4.742188 L 12.453125 4.742188 L 12.453125 7.109375 L 10.773438 7.109375 Z M 10.773438 3.554688 '
                        })
                    ])
                ]),
                m('span', { class: 'Button-label' }, app.translator.trans('therealsujitk.forum.gifs.label'))
            ]),
        10);
    });
});
