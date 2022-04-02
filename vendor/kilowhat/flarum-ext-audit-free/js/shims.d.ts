import Mithril from 'mithril';
import * as _dayjs from 'dayjs';

declare global {
    const m: Mithril.Static;
    const dayjs: typeof _dayjs;
}
