<?php

use Flarum\Extend;
use Flarum\Frontend\Document;

return [

    // Disables local file upload for FoF Upload extension:
    (new \FoF\Upload\Extend\Adapters())->disable('local'),

    // Remove (permanently throttle) test mail function:
    (new Flarum\Extend\ThrottleApi)->set('throttleMailTests', function ($request) {
        if ($request->getAttribute('routeName') === 'mailTest') {
            return true;
        }
     }),

    (new Extend\Frontend('forum'))->content(function (Document $document) {

            // FreeFlarum's foter:
            if (!file_exists("/etc/hide_powered_by")) {
                $document->foot[] = '
                    <div style="height: initial !important; position: absolute !important; width: 100% !important; clip-path: unset !important; transform: unset !important; color: unset !important; background-color: unset !important; visibility: visible !important; display: block !important; text-align: center !important; margin: 5px 0 !important; opacity: 1.0 !important; max-height: unset !important; padding: 10px 0 !important; font-family: \'Poppins\', sans-serif !important; font-size: 11px !important;">
                    A free forum powered by <a href="https://www.freeflarum.com" target="_blank">FreeFlarum.com</a> (<a href="https://www.freeflarum.com/docs/faq/#can-i-pay-to-remove-the-powered-by-freeflarum-footer-for-my-or-other-forum" target="_blank">remove this footer</a>)<br/><a href="https://www.freeflarum.com/docs/legal/terms/" target="_blank">Terms & Conditions</a> | <a href="https://www.freeflarum.com/docs/faq/#can-i-report-a-forum-that-violates-your-terms-conditions-or-is-inappropriate-by-any-other-means" target="_blank">Report This Forum</a> | <a href="https://www.freeflarum.com/docs/legal/privacy-policy/" target="_blank">Privacy Policy</a>
                    </div></div>
                ';
            };

            // Cookie Consent (not needed as long as fof/cookie-consent exists?):
            // $document->foot[] = '<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?always=1&hideDetailsBtn=1"></script>';

            // Signature:
            $document->foot[] = '<!-- FreeFlarum.com -->';
    }),

    (new Extend\Frontend('admin'))->content(function (Document $document) {

        // Adds notice about upgrading to higher Flarum version (in case the vendor patch doesn't want to work, for some reason):
        /*$document->head[] = '
            <p style="margin: 0; font-size: 13px; text-align: center; padding: 15px 12.5vw; background: #f0e87d; color: black;">
                <i class="fas fa-exclamation-triangle" style="margin-right: 10px;"></i> 
                We are currently upgrading all forums to Flarum beta.15. There might be some downtimes and outages. Some of the extensions will be removed due to incompatibility. Your forum might stop working after the upgrade.
                <a href="https://discuss.flarum.org/d/7585/1795">Read more</a>.<br/>
                <i style="color: #666666; font-size: 12px;">This notice will disappear when all forums are updated.</i>
             </p>
        ';*/

        // News box at the bottom of the admin panel:
        $document->foot[] = '
            <style>@media only screen and (max-width: 991px) { #tip, #news { width: 95% !important; left: 2.5% !important; }; }
            </style>
            <hr/>
            <div id="news" align="center" style="width: 100%; font-size: 1rem;">
                <p style="font-size: 1.25rem; font-weight: 800; text-decoration: underline; margin-bottom: 5px;">What\'s new?</p>
                <a style="margin-top: 5px; font-weight: 900;" href="https://discuss.flarum.org/d/7585/2224" target="_blank">21/02/2021 - Upgraded MariaDB of all forums - Flarum PWA & Discussion Language extensions appear!</a>
                <br/>
            </p>
            <br/>
        ';

        // Change "Get Help" link in the top right corner of admin panel (beta.15):
        $document->foot[] = '<script>
            globalThis.window.document.querySelector("#header-secondary > ul > li.item-help > a[href=\"https://docs.flarum.org/troubleshoot.html\"]").setAttribute("href", "https://discuss.flarum.org/d/7585");
            </script>';

        // Hide test mail button (already removed in the Throttle API, but better get this off sight) and upgrade banner (temp-fix, strange how it didn't disappear, even though I can't see it anywhere in the files and clearing cache doesn't help):
        /*$document->head[] = '<style>
            #content > div > div.container > form > fieldset:nth-child(5) { display: none; }
            </style>';*/
    })
];