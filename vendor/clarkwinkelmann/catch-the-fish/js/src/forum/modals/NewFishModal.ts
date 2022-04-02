import app from 'flarum/forum/app';
import Modal from 'flarum/common/components/Modal';
import EditFish from '../components/EditFish';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.new-fish-modal.';

export default class NewFishModal extends Modal {
    className() {
        return 'Modal--small';
    }

    title() {
        return app.translator.trans(translationPrefix + 'title');
    }

    content() {
        return m('.Modal-body', m(EditFish, {
            round: this.attrs.round,
            onsave: () => {
                this.hide();

                if (this.attrs.oncreateordelete) {
                    this.attrs.oncreateordelete();
                }
            },
        }));
    }
}
