<?php

use Flarum\Extend;
use Flarum\Frontend\Document;

return [
    // Adds notice about upgrading to higher Flarum version:
    /*(new Extend\Frontend('forum'))->content(function (Document $document) {
        $document->head[] = '
            <p style="margin: 0; font-size: 13px; text-align: center; padding: 15px 12.5vw; background: #f0e87d; color: black;"><i class="fas fa-exclamation-triangle" style="margin-right: 10px;"></i> We\'re currently upgrading to Flarum beta.14.1. There might be downtimes & outages. Some of the extensions will be removed due to incompatibility. <a href="https://discuss.flarum.org/d/7585-free-flarum-hosting-on-an-expert-platform-by-freeflarum-com/1689">Read more</a>.<br/><i style="color: #666666; font-size: 11px;">This notice will disappear as soon as we update.</i></p>
        ';
    }),*/
    // Disables local file upload for FoF Upload extension:
    (new \FoF\Upload\Extend\Adapters())->disable('local'),

    // Adds the FreeFlarum footer:
    (new Extend\Frontend('forum'))->content(function (Document $document) {
            if (!file_exists("/etc/hide_powered_by")) {
                $document->foot[] = '
                    <hr/><p align="center" style="text-align: center !important; height: initial !important; position: initial !important; clip-path: unset !important; transform: unset !important; color: unset !important; background-color: unset !important; visibility: visible !important; display: block !important; text-align: center !important; margin: 5px 0 !important; opacity: 1.0 !important; max-height: unset !important; padding: 10px 0 !important; font-family: \'Arial\', sans-serif !important; font-size: 13px !important;">A free forum powered by <a href="https://www.freeflarum.com" target="_blank">FreeFlarum</a> (<a href="https://www.freeflarum.com/docs/faq/#can-i-pay-to-remove-the-powered-by-freeflarum-footer-for-my-or-other-forum" target="_blank">remove this footer</a>)<br/><a href="https://www.freeflarum.com/docs/legal/terms/" target="_blank">Terms & Conditions</a> | <a href="https://www.freeflarum.com/docs/faq/#can-i-report-a-forum-that-violates-your-terms-conditions-or-is-inappropriate-by-any-other-means" target="_blank">Report This Forum</a> | <a href="https://www.freeflarum.com/docs/legal/privacy-policy/" target="_blank">Privacy Policy</a></p></div>
                ';
            };
            $document->foot[] = '<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?always=1&hideDetailsBtn=1"></script>';
    }),

    // Adds news box to the bottom of the admin panel:
    (new Extend\Frontend('admin'))->content(function (Document $document) {
        $document->foot[] = '
            <style>#content > div > div > form > fieldset:nth-child(7) { display: none; }@media only screen and (max-width: 991px) { #tip, #news { width: 95% !important; left: 2.5% !important; }; }
            </style>
            <hr/>
            <div id="news" align="center" style="width: 100%; bottom: -10px;">
                <p style="font-size: 1.1rem; font-weight: 800; text-decoration: underline; margin-bottom: 5px;">What\'s new?</p>
                <a style="margin-top: 5px;" href="https://discuss.flarum.org/d/7585-free-flarum-hosting-on-an-expert-platform-by-freeflarum-com/1689" target="_blank">06/12/2020 - Flarum beta.14.1 upgrade</a>
            </p>
            <br/>
        ';
    })
];