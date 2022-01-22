/*
 *  FancyBox Extension for Flarum
 *  Copyright (C) 2019 Eleanor Hawk
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 */

import { extend } from 'flarum/extend';
import CommentPost from 'flarum/components/CommentPost';
import ModalManager from 'flarum/components/ModalManager';
import fancybox from "@fancyapps/fancybox";

function categorizeImages(element) {
  const imageWrapperHtml = '<div class="image-wrapper"></div>';
  const badgeHtml = `
    <div class="extlink-badge">
      <span></span>
    </div>`;
  var captionHtml = function (caption) {
    return `
      <div class="caption-wrapper">
        <span>` + caption + `</span>
      </div>
    `;
  };

  $(element).find('p, th, td').children('img:not([class]):not([data-nothing-fancy])').each((i, e) => {
    let caption = $(e).attr('title') || '';

    if ($(e).parent().contents().length === 1) {
      $(e).addClass('block-image');
      $(e).wrap('<a class="block-image-self-link" role="button">' + imageWrapperHtml + '</a>');
    } else {
      $(e).addClass('inline-image');
      $(e).wrap('<a class="inline-image-self-link" role="button">' + imageWrapperHtml + '</a>');
    }

    $(e).parent().append(badgeHtml);
    if (caption !== '') $(e).closest('a').append(captionHtml(caption));
  });

  $(element).find('p, th, td').find(`a:not(
      .block-image-link,
      .inline-image-link,
      .block-image-self-link,
      .inline-image-self-link
    ) > img:not([class])`).each((i, e) => {
    let link = $(e).parent();

    if (typeof $(e).data('nothing-fancy') !== 'undefined'
          && !(link.hasClass('fancybox--iframe-link') || link.hasClass('fancybox--video-link'))) {
    	return true;
    }

    let caption = $(e).attr('title') || link.attr('title') || '';

    if (link.contents().length === 1
      && link.parent().contents().length === 1) {
      $(e).addClass('block-image');
      if ($(e).attr('src') !== link.attr('href')) {
        link.addClass('block-image-link');
      } else {
        link.addClass('block-image-self-link');
      }
    } else {
      $(e).addClass('inline-image');
      if ($(e).attr('src') !== link.attr('href')) {
        link.addClass('inline-image-link');
      } else {
        link.addClass('inline-image-self-link');
      }
    }

    link.append(badgeHtml);
    link.wrapInner(imageWrapperHtml);
    if (caption !== '') link.append(captionHtml(caption));
  });
}

app.initializers.add('malago-fancybox', app => {
  $.fancybox.defaults.toolbar = false;
  $.fancybox.defaults.smallBtn = true;
  $.fancybox.defaults.lang = app.translator.locale;
  $.fancybox.defaults.i18n[app.translator.locale] = {
    NEXT: app.translator.trans('malago-fancybox.forum.next'),
    PREV: app.translator.trans('malago-fancybox.forum.prev'),
    CLOSE: app.translator.trans('malago-fancybox.forum.close'),
    ERROR: app.translator.trans('malago-fancybox.forum.error')
  }

  const selectors = `
    a.block-image-self-link,
    a.inline-image-self-link,
    a.fancybox--iframe-link,
    a.fancybox--video-link
  `;

  extend(CommentPost.prototype, 'oncreate', function(x, isInitialized, context) {
    categorizeImages(this.element);
    
    $(this.element).find(selectors).click((e) => e.preventDefault());

    if (!this.isEditing() && !('fancybox_gallery' in this)) {
      let fancies = $(this.element).find(selectors).not(`
        a.block-image-link *,
        a.inline-image-link *`
      );

      let gallery = fancies.map((i, e) => {
        let type;
        let caption = $(e).find('img').attr('title') || $(e).attr('title') || '';
        let src = $(e).attr('href') || $(e).find('img').attr('src');

        if ($(e).hasClass('fancybox--iframe-link')) {
          type = 'iframe';
        } else if (!$(e).hasClass('fancybox--video-link')) {
          type = 'image';
        }

        return {
          src: src,
          type: type,
          opts : {
            caption : caption
      		}
        }
      });

      this.fancybox_gallery = gallery.length ? gallery : false;

      if (this.fancybox_gallery) {
        fancies.each((i, e) => {
          let index = i;

          $(e).off('click.fancybox');
          $(e).on('click.fancybox', (event) => {
            $.fancybox.open(this.fancybox_gallery, {}, index);
          });
        });
      }
    } else if (this.isEditing() && 'fancybox_gallery' in this) {
      delete this.fancybox_gallery;
    }
  });

  extend(ModalManager.prototype, 'show', function (x) {
    $.fancybox.close();
  })

  if (s9e && s9e.TextFormatter) {
    extend(s9e.TextFormatter, 'preview', function(x, preview, element) {
      if (element.matches('.Post *'))
        categorizeImages(element);
    });
  }
});
