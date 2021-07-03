import Mithril from 'mithril';

declare global {
    const m: Mithril.Static;
}

import Discussion from 'flarum/common/models/Discussion';
import Post from 'flarum/common/models/Post';
import User from 'flarum/common/models/User';

declare module 'flarum/common/models/Discussion' {
    export default interface Discussion {
        user(): User | false

        createdAt(): Date

        firstPost(): Post | false
    }
}

declare module 'flarum/common/models/Post' {
    export default interface Post {
        number(): number

        createdAt(): Date

        editedAt(): Date | null

        user(): User | false

        discussion(): Discussion | false
    }
}
