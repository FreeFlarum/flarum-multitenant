import Modal from 'flarum/components/Modal';

export default class SignatureLoadingModal extends Modal {
    oninit(vnode) {
        super.oninit(vnode);

        this.value = this.attrs.value;
        this.titleText = this.attrs.titleText || '';
        this.close = this.attrs.close || false;
        this.errors = this.attrs.errors || false;
    }

    title() {
        return this.titleText;
    }

    isDismissible() {
        return this.close;
    }

    className() {
        return 'LoadingModal Modal--small';
    }

    content() {
        let ErrorWindow = '';
        if (this.errors) {
            ErrorWindow = m(
                'ul',
                this.errors.map(function (error) {
                    return m('li', {}, error);
                })
            );
        }
        return (
            <div className="Modal-body">
                <p>{this.value}</p>
                {ErrorWindow}
            </div>
        );
    }
}
