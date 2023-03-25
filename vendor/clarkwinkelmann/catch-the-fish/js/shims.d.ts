import Mithril from 'mithril';
import * as _dayjs from 'dayjs';

declare global {
    const m: Mithril.Static;
    const dayjs: typeof _dayjs;

    interface FlarumExports {
        extensions: {
            [id: string]: any
        }
        core: {
            compat: {
                [id: string]: any
            }
        }
    }

    const flarum: FlarumExports
}

import Fish from './src/forum/models/Fish';
import Round from './src/forum/models/Round';

declare module 'flarum/common/models/User' {
    export default interface User {
        catchTheFishBasket(): Fish[] | false
    }
}

declare module 'flarum/common/models/Forum' {
    export default interface Forum {
        catchTheFishActiveRounds(): Round[] | false

        catchTheFishCanModerate(): boolean

        catchTheFishCanSeeRankingsPage(): boolean

        catchTheFishAnimateFlip(): boolean
    }
}

declare module 'flarum/forum/ForumApplication' {
    export default interface ForumApplication {
        draggedFishId?: string | null
    }
}
