import Mithril from 'mithril';
import * as _dayjs from 'dayjs';

declare global {
    const m: Mithril.Static;
    const dayjs: typeof _dayjs;
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

        catchTheFishCanSeeProfileRankings(): boolean

        catchTheFishAnimateFlip(): boolean
    }
}
