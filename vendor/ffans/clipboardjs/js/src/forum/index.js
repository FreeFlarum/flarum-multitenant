import { extend } from 'flarum/common/extend';

import CommentPost from 'flarum/forum/components/CommentPost';
import ClipboardJS from 'clipboard';

import { getTheme } from './getTheme';
import { codeLang } from "./codeLang";

app.initializers.add('ffans/clipboardjs', () => {

    var clipboard = null;
    var theme_name, btnChild, btnChildT, btnChildF;

    function getAtt(key) {
        return app.forum.attribute(key);
    }
    function getTrans(key) {
        return app.translator.trans('ffans-clipboardjs.forum.' + key);
    }

    extend(CommentPost.prototype, 'oncreate', function () {
        theme_name = (getAtt('themeName') == '') ? 'default' : getAtt('themeName');

        if (getAtt('isCopyEnable') == 1) {
            btnChild = getTheme(theme_name)[0];
            btnChildT = getTheme(theme_name)[1];
            btnChildF = getTheme(theme_name)[2];

            var pres = this.element.querySelectorAll('pre');
            console.log('获取 pre' + pres);
            [].forEach.call(pres, function (pre) {
                if (pre.className.indexOf("copy-ready") == -1)
                    pre.insertAdjacentHTML('afterBegin',
                        '<button class="clipboard ' + theme_name + '" data-clipboard-snippet="">' + btnChild + '</button>'
                    );
                pre.classList.add("copy-ready");
                if (theme_name == 'lingcoder' || theme_name == 'csdn') {
                    pre.classList.add("sticky");
                }
            });
        }
        if (getAtt('isShowCodeLang') == 1) {
            codeLang();
        }
    });
    
    if (clipboard) {
        clipboard.destroy();
    }

    clipboard = new ClipboardJS('[data-clipboard-snippet]', {
        target: function (trigger) {
            return trigger.nextElementSibling;
        }
    });

    clipboard.on('success', function (e) {
        console.info('Action:', e.action);

        e.trigger.classList.add("succeed");

        if (isNaN(btnChildT))
            e.trigger.innerHTML = btnChildT;

        setTimeout(function () {
            e.trigger.classList.remove("succeed");
            e.trigger.innerHTML = btnChild;
        }, 1000)

        e.clearSelection();
    });

    clipboard.on('error', function (e) {
        console.error('Action:', e.action);

        e.trigger.classList.add("failed");
        if (isNaN(btnChildT))
            e.trigger.innerHTML = btnChildF;

        setTimeout(function () {
            e.trigger.classList.remove("failed");
            e.trigger.innerHTML = btnChild;
        }, 1000)

        fallbackMessage(e.action);
    });

    function fallbackMessage(action) {
        var actionMsg = '';
        var actionKey = (action === 'cut' ? 'X' : 'C');
        action = (action === 'copy') ? getTrans('action_copy') : getTrans('action_cut');
        if (/iPhone|iPad/i.test(navigator.userAgent)) {
            actionMsg = getTrans('no_support') + ' :(';
        } else if (/Mac/i.test(navigator.userAgent)) {
            actionMsg = app.translator.trans('ffans-clipboardjs.forum.msg', {
                actionKey: '⌘-' + actionKey,
                action: action,
            });
        } else {
            actionMsg = app.translator.trans('ffans-clipboardjs.forum.msg', {
                actionKey: 'Ctrl-' + actionKey,
                action: action,
            });
        }
        actionMsg = actionMsg.join("");
        console.log(actionMsg);
        alert(actionMsg);
    }
});
