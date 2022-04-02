import app from 'flarum/common/app';

export function getTheme(theme_name) {
    var btnChild, btnChildT, btnChildF;
    btnChild = btnChildT = btnChildF = null;
    switch (theme_name) {
        case 'github':
            btnChild = '<svg aria-hidden="true" role="img" class="clipboard-icon" viewBox="0 0 16 16" width="16" height="16" fill="currentColor" style="display: inline-block; user-select: none; vertical-align: text-bottom;"><path fill-rule="evenodd" d="M5.75 1a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-3a.75.75 0 00-.75-.75h-4.5zm.75 3V2.5h3V4h-3zm-2.874-.467a.75.75 0 00-.752-1.298A1.75 1.75 0 002 3.75v9.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-9.5a1.75 1.75 0 00-.874-1.515.75.75 0 10-.752 1.298.25.25 0 01.126.217v9.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-9.5a.25.25 0 01.126-.217z"></path></svg>';
            btnChildT = '<svg aria-hidden="true" role="img" class="clipboard-icon" viewBox="0 0 16 16" width="16" height="16" fill="currentColor" style="display: inline-block; user-select: none; vertical-align: text-bottom;"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>';
            btnChildF = '<svg aria-hidden="true" role="img" class="clipboard-icon" viewBox="0 0 16 16" width="16" height="16" fill="currentColor" style="display: inline-block; user-select: none; vertical-align: text-bottom;"><path fill-rule="evenodd" d="M 3.72 3.72 a 0.75 0.75 0 0 1 1.06 0 L 8 6.94 l 3.22 -3.22 a 0.75 0.75 0 1 1 1.06 1.06 L 9.06 8 l 3.22 3.22 a 0.75 0.75 0 1 1 -1.06 1.06 L 8 9.06 l -3.22 3.22 a 0.75 0.75 0 0 1 -1.06 -1.06 L 6.94 8 L 3.72 4.78 a 0.75 0.75 0 0 1 0 -1.06 Z"></path></svg>';
            break;
        case 'lingcoder':
            btnChild = '<span class="label">'+app.translator.trans('ffans-clipboardjs.forum.action_copy')+'</span>';
            btnChildT = '<span class="success">'+app.translator.trans('ffans-clipboardjs.forum.ok_btn')+'</span>';
            btnChildF = '<span class="error">'+app.translator.trans('ffans-clipboardjs.forum.error_btn')+'</span>';
            break;
        case 'csdn':
            btnChild = '<span class="label">'+app.translator.trans('ffans-clipboardjs.forum.action_copy')+'</span>';
            btnChildT = '<span class="success">'+app.translator.trans('ffans-clipboardjs.forum.ok_btn')+'</span>';
            btnChildF = '<span class="error">'+app.translator.trans('ffans-clipboardjs.forum.error_btn')+'</span>';
            break;
        case 'cnblog':
            btnChild = '<i class="fas fa-code"></i>';
            btnChildT = '<i class="fas fa-check"></i>';
            btnChildF = '<i class="fas fa-times"></i>';
            break;
        case 'jianshu':
            btnChild = '<svg viewBox="64 64 896 896" focusable="false" class="" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path></svg>';
            btnChildT = '<svg aria-hidden="true" role="img" class="clipboard-icon" viewBox="0 0 16 16" width="16" height="16" fill="currentColor" style="display: inline-block; user-select: none; vertical-align: text-bottom;"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>';
            btnChildF = '<svg aria-hidden="true" role="img" class="clipboard-icon" viewBox="0 0 16 16" width="16" height="16" fill="currentColor" style="display: inline-block; user-select: none; vertical-align: text-bottom;"><path fill-rule="evenodd" d="M 3.72 3.72 a 0.75 0.75 0 0 1 1.06 0 L 8 6.94 l 3.22 -3.22 a 0.75 0.75 0 1 1 1.06 1.06 L 9.06 8 l 3.22 3.22 a 0.75 0.75 0 1 1 -1.06 1.06 L 8 9.06 l -3.22 3.22 a 0.75 0.75 0 0 1 -1.06 -1.06 L 6.94 8 L 3.72 4.78 a 0.75 0.75 0 0 1 0 -1.06 Z"></path></svg>';
            break;
        case 'segmentfault':
            btnChild = '<i class="fas fa-copy"></i>';
            break;
        default:
            btnChild = '<svg t="1615106038398" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="790" width="14.5" height="15.5"><path d="M192 768h256v64H192v-64z m320-384H192v64h320v-64z m128 192V448L448 640l192 192V704h320V576H640z m-288-64H192v64h160v-64zM192 704h160v-64H192v64z m576 64h64v128c-1 18-7 33-19 45s-27 18-45 19H128c-35 0-64-29-64-64V192c0-35 29-64 64-64h192C320 57 377 0 448 0s128 57 128 128h192c35 0 64 29 64 64v320h-64V320H128v576h640V768zM192 256h512c0-35-29-64-64-64h-64c-35 0-64-29-64-64s-29-64-64-64-64 29-64 64-29 64-64 64h-64c-35 0-64 29-64 64z" p-id="791"></path></svg>';
            break;
    }
    return [btnChild, btnChildT, btnChildF];
}