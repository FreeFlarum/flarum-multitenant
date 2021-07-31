<?php

// Prepare FreeFlarum config:
$flarum_conf_path = dirname(__FILE__) . "/../etc/flarum.json";

/* Had to use globals, so the variables are accessible from anywhere in this file. */
define('CONF', json_decode(file_get_contents($flarum_conf_path), true));

use Flarum\Extend;
use Flarum\Frontend\Document;


// Disables local file upload for FoF Upload extension, if it's not enabled:
function disableLocalUpload() {
    if (isset(CONF['freeflarum']['amount_donated']) ? CONF['freeflarum']['amount_donated'] < 20 : true) {
        return (new \FoF\Upload\Extend\Adapters())->disable('local');
    } else {
        // Silly placeholder, since we can't return nothing - Flarum would crash.
        return (new Extend\Frontend('forum'))->content(function (Document $document) {$document->foot[] = '<!-- You can upload locally too, wowee! -->'; });
    }
}


return [
    disableLocalUpload(),

    // Remove (permanently throttle) test mail function, if not allowed:
    /*(new Flarum\Extend\ThrottleApi)->set('throttleMailTests', function ($request) {
        if (isset(CONF['freeflarum']['extend']['allow_mail_test']) ? !CONF['freeflarum']['extend']['allow_mail_test'] : true) {
            if ($request->getAttribute('routeName') === 'mailTest') {
                return true;
            };
        };
     }),*/

    (new Extend\Frontend('forum'))->content(function (Document $document) {

            // FreeFlarum's footer:
            if (isset(CONF['freeflarum']['amount_donated']) ? CONF['freeflarum']['amount_donated'] < 7 : true) {
                $document->foot[] = '
                    <hr/><p align="center" style="text-align: center !important; height: initial !important; position: initial !important; clip-path: unset !important; transform: unset !important; color: unset !important; background-color: unset !important; visibility: visible !important; display: block !important; text-align: center !important; margin: 5px 0 !important; opacity: 1.0 !important; max-height: unset !important; padding: 10px 0 !important; font-family: \'Arial\', sans-serif !important; font-size: 13px !important;">A free forum powered by <a href="https://www.freeflarum.com" target="_blank">FreeFlarum</a> (<a href="https://www.freeflarum.com/docs/faq/#can-i-pay-to-remove-the-powered-by-freeflarum-footer-for-my-or-other-forum" target="_blank">remove this footer</a>)<br/><a href="https://www.freeflarum.com/docs/legal/terms/" target="_blank">Terms & Conditions</a> | <a href="https://www.freeflarum.com/docs/legal/privacy-policy/" target="_blank">Privacy Policy</a></p></div>
                ';
            };

            // Cookie Consent (not needed as long as fof/cookie-consent exists?):
            if (isset(CONF['freeflarum']['features']['show_cookie_bar']) ? CONF['freeflarum']['features']['show_cookie_bar'] : false) {
                $document->foot[] = '<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?always=1&hideDetailsBtn=1"></script>';
            };

            // Source Signature:
            if (isset(CONF['freeflarum']['ads']['hide_source_signature']) ? !CONF['freeflarum']['ads']['hide_source_signature'] : true) {
                $document->foot[] = '<!-- FreeFlarum.com -->';
            };
    }),

    (new Extend\Frontend('admin'))->content(function (Document $document) {
        // Important alert on top:
        /*$document->head[] = '
            <div style="text-align: center; padding: 0.5rem 0;">
                <a style="color: red; font-weight: 900;" href="https://discuss.flarum.org/d/7585/2959" target="_blank">31st July 2021 - DOWNTIME - MariaDB 10.6 update</a>
            </div>
        ';*/

        // Adds notice about upgrading to higher Flarum version:
        /*
        $document->head[] = '
            <p style="margin: 0; font-size: 13px; text-align: center; padding: 15px 12.5vw; background: #f0e87d; color: black;">
                <i class="fas fa-exclamation-triangle" style="margin-right: 10px;"></i>
                We are currently upgrading all forums to Flarum beta.16. There might be some downtimes and outages. Some of the extensions will be removed due to incompatibility. Your forum might stop working after the upgrade.
                <a style="color: darkblue;" href="https://discuss.flarum.org/d/7585/2524">Follow the progress here</a>.<br/>
                <i style="color: #666666; font-size: 12px;">This notice will disappear when all forums are upgraded.</i>
             </p>
        ';
        */

        // News box at the bottom of the admin panel:
        $document->foot[] = '
            <style>@media only screen and (max-width: 991px) { #tip, #news { width: 95% !important; left: 2.5% !important; }; }
            </style>
            <hr/>
            <div id="news" align="center" style="width: 100%; bottom: -10px;">
                <p style="font-size: 1.1rem; font-weight: 800; text-decoration: underline; margin-bottom: 5px;">What\'s new?</p>
                <a style="margin-top: 5px; font-weight: 700;" href="https://discuss.flarum.org/d/7585/2965" target="_blank">31st July 2021 - MariaDB 10.6.3 update</a>
            </p>
            <br/>
        ';

        // Change "Get Help" link in the top right corner of admin panel to direct to our discussion (from beta.15):
        //$document->foot[] = '<script>globalThis.window.document.querySelector("#header-secondary > ul > li.item-help > a[href=\"https://docs.flarum.org/troubleshoot.html\"]").setAttribute("href", "https://discuss.flarum.org/d/7585");</script>';

        // Remove Audit Log extension upgrade button, since we don't allow paid extensions:
        $document->foot[] = '<script>globalThis.window.document.querySelector(".AuditUpgrade[href=\"https://kilowhat.net/flarum/extensions/audit\"]").outerHTML = null;</script>';
    })
];
