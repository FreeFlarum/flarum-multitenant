import { extend, override } from 'flarum/common/extend';

import app from 'flarum/common/app';
import CommentPost from 'flarum/common/components/CommentPost';
import HeaderPrimary from 'flarum/common/components/HeaderPrimary';
import LogInModal from 'flarum/common/components/LogInModal';
import SignUpModal from 'flarum/common/components/SignUpModal';

app.initializers.add('jslirola-login2seeplus', function()
{
    let jslirolaLogin2seeplusReplaceImages;
    const jslirolaLogin2seeplusImgMin = 150;

    function get_link(trans)
    {
        var newlink = document.createElement('a');
        newlink.setAttribute('class', 'l2sp');
        newlink.innerHTML = app.translator.trans(trans);
        return newlink.outerHTML;
    }

    extend(HeaderPrimary.prototype, 'oninit', function ()
    {
        jslirolaLogin2seeplusReplaceImages = JSON.parse(app.forum.attribute('jslirola.login2seeplus.image') || 0);
    });

    extend(CommentPost.prototype, 'content', function(list)
    {
        if (app.session.user || this.isEditing())
            return;

        let oldContent = list[1].children[0].children;
        let newContent = oldContent;
        let subbedContent = false;

        // replace images
        if (jslirolaLogin2seeplusReplaceImages)
        {

            let imgCounter = 0;
            newContent = newContent.replace(/<img((.(?!class=))*)\/?>/g, function(html)
            {
                let img = $(html)[0];
                let src = img.src;

                let loader = new Image();
                loader.onload = function()
                {
                    let imgWidth = loader.width;
                    let imgHeight = loader.height;
                    imgWidth = imgWidth > jslirolaLogin2seeplusImgMin ? imgWidth : jslirolaLogin2seeplusImgMin;
                    imgHeight = imgHeight > jslirolaLogin2seeplusImgMin ? imgHeight : jslirolaLogin2seeplusImgMin;
                    $('.wlip' + this.counter).width(imgWidth);
                    $('.wlip' + this.counter).height(imgHeight);
                }

                loader.counter = imgCounter;
                loader.src = src;

                return '<div class="jslirolaLogin2seeplusImgPlaceholder wlip' + (imgCounter++) + '">' + get_link('jslirola-login2seeplus.forum.image') + '</div>';
            });
        }

        if (subbedContent)
            newContent += '<div class="jslirolaLogin2seeplusAlert">' + app.translator.trans('jslirola-login2seeplus.forum.post',
            {
                login: "<a class='jslirolaLogin2seeplusLogin'>" + app.translator.trans('core.forum.header.log_in_link') + "</a>",
                register: "<a class='jslirolaLogin2seeplusRegister'>" + app.translator.trans('core.forum.header.sign_up_link') + "</a>"
            }).join('') + '</div>';

        list[1].children[0] = m.trust(newContent);

    });

    extend(CommentPost.prototype, 'oncreate', function()
    {
        $('.Post-body a.l2sp').off('click').on('click', () => app.modal.show(LogInModal));
        $('.jslirolaLogin2seeplusLogin').off('click').on('click', () => app.modal.show(LogInModal));
        $('.jslirolaLogin2seeplusRegister').off('click').on('click', () => app.modal.show(SignUpModal));
    });

});
