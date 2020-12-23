export default class RequestsListState {
    constructor(app) {
        this.app = app;

        /**
         * Whether or not the flags are loading.
         *
         * @type {Boolean}
         */
        this.loading = false;

        this.cache = [];
    }

    load() {
        if (app.cache.username_requests) {
            return;
        }

        this.loading = true;
        m.redraw();

        app.store
            .find('username-requests')
            .then((requests) => {
                delete requests.payload;
                app.cache.username_requests = requests.sort((a, b) => a.createdAt() - b.createdAt());
            })
            .catch(() => {})
            .then(() => {
                this.loading = false;
                m.redraw();
            });
    }
}
