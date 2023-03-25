
window.projectVersion = 'main';

(function (root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul>    <li data-name="namespace:Maicol07"        class="opened">        <div style="padding-left:0px" class="hd">            <span class="icon icon-play"></span>                            <a href="Maicol07.html">Maicol07</a>                    </div>        <div class="bd">            <ul>    <li data-name="namespace:Maicol07_SSO"        class="opened">        <div style="padding-left:18px" class="hd">            <span class="icon icon-play"></span>                            <a href="Maicol07/SSO.html">SSO</a>                    </div>        <div class="bd">            <ul>    <li data-name="namespace:Maicol07_SSO_Addons"        >        <div style="padding-left:36px" class="hd">            <span class="icon icon-play"></span>                            <a href="Maicol07/SSO/Addons.html">Addons</a>                    </div>        <div class="bd">            <ul>    <li data-name="class:Maicol07_SSO_Addons_Core" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/Addons/Core.html">Core</a>        </div>    </li>        <li data-name="class:Maicol07_SSO_Addons_Groups" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/Addons/Groups.html">Groups</a>        </div>    </li>    </ul></div>    </li>        <li data-name="namespace:Maicol07_SSO_Exceptions"        >        <div style="padding-left:36px" class="hd">            <span class="icon icon-play"></span>                            <a href="Maicol07/SSO/Exceptions.html">Exceptions</a>                    </div>        <div class="bd">            <ul>    <li data-name="class:Maicol07_SSO_Exceptions_MissingRequiredAddonException" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/Exceptions/MissingRequiredAddonException.html">MissingRequiredAddonException</a>        </div>    </li>    </ul></div>    </li>        <li data-name="namespace:Maicol07_SSO_Traits"        >        <div style="padding-left:36px" class="hd">            <span class="icon icon-play"></span>                            <a href="Maicol07/SSO/Traits.html">Traits</a>                    </div>        <div class="bd">            <ul>    <li data-name="class:Maicol07_SSO_Traits_Addons" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/Traits/Addons.html">Addons</a>        </div>    </li>        <li data-name="class:Maicol07_SSO_Traits_Basic" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/Traits/Basic.html">Basic</a>        </div>    </li>        <li data-name="class:Maicol07_SSO_Traits_Cookies" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/Traits/Cookies.html">Cookies</a>        </div>    </li>    </ul></div>    </li>        <li data-name="namespace:Maicol07_SSO_User"        >        <div style="padding-left:36px" class="hd">            <span class="icon icon-play"></span>                            <a href="Maicol07/SSO/User.html">User</a>                    </div>        <div class="bd">            <ul>    <li data-name="namespace:Maicol07_SSO_User_Traits"        >        <div style="padding-left:54px" class="hd">            <span class="icon icon-play"></span>                            <a href="Maicol07/SSO/User/Traits.html">Traits</a>                    </div>        <div class="bd">            <ul>    <li data-name="class:Maicol07_SSO_User_Traits_Auth" >        <div style="padding-left:80px" class="hd leaf">            <a href="Maicol07/SSO/User/Traits/Auth.html">Auth</a>        </div>    </li>    </ul></div>    </li>        <li data-name="class:Maicol07_SSO_User_Attributes" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/User/Attributes.html">Attributes</a>        </div>    </li>        <li data-name="class:Maicol07_SSO_User_Relationships" >        <div style="padding-left:62px" class="hd leaf">            <a href="Maicol07/SSO/User/Relationships.html">Relationships</a>        </div>    </li>    </ul></div>    </li>        <li data-name="class:Maicol07_SSO_Flarum" >        <div style="padding-left:44px" class="hd leaf">            <a href="Maicol07/SSO/Flarum.html">Flarum</a>        </div>    </li>        <li data-name="class:Maicol07_SSO_User" >        <div style="padding-left:44px" class="hd leaf">            <a href="Maicol07/SSO/User.html">User</a>        </div>    </li>    </ul></div>    </li>    </ul></div>    </li>    </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [

        {
            "type": "Namespace",
            "link": "Maicol07.html",
            "name": "Maicol07",
            "doc": "Namespace Maicol07"
        }, {
            "type": "Namespace",
            "link": "Maicol07/SSO.html",
            "name": "Maicol07\\SSO",
            "doc": "Namespace Maicol07\\SSO"
        }, {
            "type": "Namespace",
            "link": "Maicol07/SSO/Addons.html",
            "name": "Maicol07\\SSO\\Addons",
            "doc": "Namespace Maicol07\\SSO\\Addons"
        }, {
            "type": "Namespace",
            "link": "Maicol07/SSO/Exceptions.html",
            "name": "Maicol07\\SSO\\Exceptions",
            "doc": "Namespace Maicol07\\SSO\\Exceptions"
        }, {
            "type": "Namespace",
            "link": "Maicol07/SSO/Traits.html",
            "name": "Maicol07\\SSO\\Traits",
            "doc": "Namespace Maicol07\\SSO\\Traits"
        }, {
            "type": "Namespace",
            "link": "Maicol07/SSO/User.html",
            "name": "Maicol07\\SSO\\User",
            "doc": "Namespace Maicol07\\SSO\\User"
        }, {
            "type": "Namespace",
            "link": "Maicol07/SSO/User/Traits.html",
            "name": "Maicol07\\SSO\\User\\Traits",
            "doc": "Namespace Maicol07\\SSO\\User\\Traits"
        },

        {
            "type": "Class",
            "fromName": "Maicol07\\SSO\\Addons",
            "fromLink": "Maicol07/SSO/Addons.html", "link": "Maicol07/SSO/Addons/Core.html",
            "name": "Maicol07\\SSO\\Addons\\Core",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Addons\\Core", "fromLink":
                "Maicol07/SSO/Addons/Core.html", "link":
                "Maicol07/SSO/Addons/Core.html#method___construct", "name":
                "Maicol07\\SSO\\Addons\\Core::__construct", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Addons\\Core", "fromLink":
                "Maicol07/SSO/Addons/Core.html", "link":
                "Maicol07/SSO/Addons/Core.html#method_load", "name":
                "Maicol07\\SSO\\Addons\\Core::load", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Addons\\Core", "fromLink":
                "Maicol07/SSO/Addons/Core.html", "link":
                "Maicol07/SSO/Addons/Core.html#method_unload", "name":
                "Maicol07\\SSO\\Addons\\Core::unload", "doc":
                "null"
        },

        {
            "type": "Class",
            "fromName": "Maicol07\\SSO\\Addons",
            "fromLink": "Maicol07/SSO/Addons.html", "link": "Maicol07/SSO/Addons/Groups.html",
            "name": "Maicol07\\SSO\\Addons\\Groups",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Addons\\Groups", "fromLink":
                "Maicol07/SSO/Addons/Groups.html", "link":
                "Maicol07/SSO/Addons/Groups.html#method_setGroups", "name":
                "Maicol07\\SSO\\Addons\\Groups::setGroups", "doc":
                "&quot;Sets groups to a user&quot;"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Addons\\Groups", "fromLink":
                "Maicol07/SSO/Addons/Groups.html", "link":
                "Maicol07/SSO/Addons/Groups.html#method_createGroup", "name":
                "Maicol07\\SSO\\Addons\\Groups::createGroup", "doc":
                "null"
        },

        {
            "type": "Class",
            "fromName": "Maicol07\\SSO\\Exceptions",
            "fromLink": "Maicol07/SSO/Exceptions.html",
            "link": "Maicol07/SSO/Exceptions/MissingRequiredAddonException.html",
            "name": "Maicol07\\SSO\\Exceptions\\MissingRequiredAddonException",
            "doc": "null"
        },

        {
            "type": "Class",
            "fromName": "Maicol07\\SSO",
            "fromLink": "Maicol07/SSO.html", "link": "Maicol07/SSO/Flarum.html",
            "name": "Maicol07\\SSO\\Flarum",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Flarum", "fromLink":
                "Maicol07/SSO/Flarum.html", "link":
                "Maicol07/SSO/Flarum.html#method___construct", "name":
                "Maicol07\\SSO\\Flarum::__construct", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Flarum", "fromLink":
                "Maicol07/SSO/Flarum.html", "link":
                "Maicol07/SSO/Flarum.html#method_logout", "name":
                "Maicol07\\SSO\\Flarum::logout", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Flarum", "fromLink":
                "Maicol07/SSO/Flarum.html", "link":
                "Maicol07/SSO/Flarum.html#method_user", "name":
                "Maicol07\\SSO\\Flarum::user", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Flarum", "fromLink":
                "Maicol07/SSO/Flarum.html", "link":
                "Maicol07/SSO/Flarum.html#method_getUsersList", "name":
                "Maicol07\\SSO\\Flarum::getUsersList", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Flarum", "fromLink":
                "Maicol07/SSO/Flarum.html", "link":
                "Maicol07/SSO/Flarum.html#method_isSessionRemembered", "name":
                "Maicol07\\SSO\\Flarum::isSessionRemembered", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Flarum", "fromLink":
                "Maicol07/SSO/Flarum.html", "link":
                "Maicol07/SSO/Flarum.html#method_redirect", "name":
                "Maicol07\\SSO\\Flarum::redirect", "doc":
                "&quot;Redirects the user to your Flarum instance&quot;"
        },

        {
            "type": "Trait"
            ,
            "fromName": "Maicol07\\SSO\\Traits",
            "fromLink": "Maicol07/SSO/Traits.html", "link": "Maicol07/SSO/Traits/Addons.html",
            "name": "Maicol07\\SSO\\Traits\\Addons",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Addons", "fromLink":
                "Maicol07/SSO/Traits/Addons.html", "link":
                "Maicol07/SSO/Traits/Addons.html#method_loadAddon", "name":
                "Maicol07\\SSO\\Traits\\Addons::loadAddon", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Addons", "fromLink":
                "Maicol07/SSO/Traits/Addons.html", "link":
                "Maicol07/SSO/Traits/Addons.html#method_unloadAddon", "name":
                "Maicol07\\SSO\\Traits\\Addons::unloadAddon", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Addons", "fromLink":
                "Maicol07/SSO/Traits/Addons.html", "link":
                "Maicol07/SSO/Traits/Addons.html#method_setAddonProperties", "name":
                "Maicol07\\SSO\\Traits\\Addons::setAddonProperties", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Addons", "fromLink":
                "Maicol07/SSO/Traits/Addons.html", "link":
                "Maicol07/SSO/Traits/Addons.html#method_isAddonLoaded", "name":
                "Maicol07\\SSO\\Traits\\Addons::isAddonLoaded", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Addons", "fromLink":
                "Maicol07/SSO/Traits/Addons.html", "link":
                "Maicol07/SSO/Traits/Addons.html#method_action_hook", "name":
                "Maicol07\\SSO\\Traits\\Addons::action_hook", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Addons", "fromLink":
                "Maicol07/SSO/Traits/Addons.html", "link":
                "Maicol07/SSO/Traits/Addons.html#method_filter_hook", "name":
                "Maicol07\\SSO\\Traits\\Addons::filter_hook", "doc":
                "null"
        },

        {
            "type": "Trait"
            ,
            "fromName": "Maicol07\\SSO\\Traits",
            "fromLink": "Maicol07/SSO/Traits.html", "link": "Maicol07/SSO/Traits/Basic.html",
            "name": "Maicol07\\SSO\\Traits\\Basic",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Basic", "fromLink":
                "Maicol07/SSO/Traits/Basic.html", "link":
                "Maicol07/SSO/Traits/Basic.html#method_login", "name":
                "Maicol07\\SSO\\Traits\\Basic::login", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Basic", "fromLink":
                "Maicol07/SSO/Traits/Basic.html", "link":
                "Maicol07/SSO/Traits/Basic.html#method_update", "name":
                "Maicol07\\SSO\\Traits\\Basic::update", "doc":
                "&quot;Updates a user. Warning! User needs to be find with username or email, so one of those two has to be the old one&quot;"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Basic", "fromLink":
                "Maicol07/SSO/Traits/Basic.html", "link":
                "Maicol07/SSO/Traits/Basic.html#method_delete", "name":
                "Maicol07\\SSO\\Traits\\Basic::delete", "doc":
                "&quot;Deletes a user from Flarum database. Generally, you should use this method when an user successfully deleted\nhis account from your SSO system (or main website)&quot;"
        },

        {
            "type": "Trait"
            ,
            "fromName": "Maicol07\\SSO\\Traits",
            "fromLink": "Maicol07/SSO/Traits.html", "link": "Maicol07/SSO/Traits/Cookies.html",
            "name": "Maicol07\\SSO\\Traits\\Cookies",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Cookies", "fromLink":
                "Maicol07/SSO/Traits/Cookies.html", "link":
                "Maicol07/SSO/Traits/Cookies.html#method_setRememberTokenCookie", "name":
                "Maicol07\\SSO\\Traits\\Cookies::setRememberTokenCookie", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Cookies", "fromLink":
                "Maicol07/SSO/Traits/Cookies.html", "link":
                "Maicol07/SSO/Traits/Cookies.html#method_generateCookie", "name":
                "Maicol07\\SSO\\Traits\\Cookies::generateCookie", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Cookies", "fromLink":
                "Maicol07/SSO/Traits/Cookies.html", "link":
                "Maicol07/SSO/Traits/Cookies.html#method_deleteRememberTokenCookie", "name":
                "Maicol07\\SSO\\Traits\\Cookies::deleteRememberTokenCookie", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Cookies", "fromLink":
                "Maicol07/SSO/Traits/Cookies.html", "link":
                "Maicol07/SSO/Traits/Cookies.html#method_setSessionTokenCookie", "name":
                "Maicol07\\SSO\\Traits\\Cookies::setSessionTokenCookie", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Cookies", "fromLink":
                "Maicol07/SSO/Traits/Cookies.html", "link":
                "Maicol07/SSO/Traits/Cookies.html#method_deleteSessionTokenCookie", "name":
                "Maicol07\\SSO\\Traits\\Cookies::deleteSessionTokenCookie", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Cookies", "fromLink":
                "Maicol07/SSO/Traits/Cookies.html", "link":
                "Maicol07/SSO/Traits/Cookies.html#method_setLogoutCookie", "name":
                "Maicol07\\SSO\\Traits\\Cookies::setLogoutCookie", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\Traits\\Cookies", "fromLink":
                "Maicol07/SSO/Traits/Cookies.html", "link":
                "Maicol07/SSO/Traits/Cookies.html#method_deleteLogoutCookie", "name":
                "Maicol07\\SSO\\Traits\\Cookies::deleteLogoutCookie", "doc":
                "null"
        },

        {
            "type": "Class",
            "fromName": "Maicol07\\SSO",
            "fromLink": "Maicol07/SSO.html", "link": "Maicol07/SSO/User.html",
            "name": "Maicol07\\SSO\\User",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User", "fromLink":
                "Maicol07/SSO/User.html", "link":
                "Maicol07/SSO/User.html#method___construct", "name":
                "Maicol07\\SSO\\User::__construct", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User", "fromLink":
                "Maicol07/SSO/User.html", "link":
                "Maicol07/SSO/User.html#method_update", "name":
                "Maicol07\\SSO\\User::update", "doc":
                "&quot;Updates a user. If user id is not set, user will be fetched. Warning! User needs to be found with username or email, so one of those two has to be the old one&quot;"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User", "fromLink":
                "Maicol07/SSO/User.html", "link":
                "Maicol07/SSO/User.html#method_delete", "name":
                "Maicol07\\SSO\\User::delete", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User", "fromLink":
                "Maicol07/SSO/User.html", "link":
                "Maicol07/SSO/User.html#method_fetch", "name":
                "Maicol07\\SSO\\User::fetch", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User", "fromLink":
                "Maicol07/SSO/User.html", "link":
                "Maicol07/SSO/User.html#method_getAttributes", "name":
                "Maicol07\\SSO\\User::getAttributes", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User", "fromLink":
                "Maicol07/SSO/User.html", "link":
                "Maicol07/SSO/User.html#method_getRelationships", "name":
                "Maicol07\\SSO\\User::getRelationships", "doc":
                "null"
        },

        {
            "type": "Class",
            "fromName": "Maicol07\\SSO\\User",
            "fromLink": "Maicol07/SSO/User.html", "link": "Maicol07/SSO/User/Attributes.html",
            "name": "Maicol07\\SSO\\User\\Attributes",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User\\Attributes", "fromLink":
                "Maicol07/SSO/User/Attributes.html", "link":
                "Maicol07/SSO/User/Attributes.html#method_toArray", "name":
                "Maicol07\\SSO\\User\\Attributes::toArray", "doc":
                "null"
        },

        {
            "type": "Class",
            "fromName": "Maicol07\\SSO\\User",
            "fromLink": "Maicol07/SSO/User.html", "link": "Maicol07/SSO/User/Relationships.html",
            "name": "Maicol07\\SSO\\User\\Relationships",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User\\Relationships", "fromLink":
                "Maicol07/SSO/User/Relationships.html", "link":
                "Maicol07/SSO/User/Relationships.html#method_toArray", "name":
                "Maicol07\\SSO\\User\\Relationships::toArray", "doc":
                "null"
        },

        {
            "type": "Trait"
            ,
            "fromName": "Maicol07\\SSO\\User\\Traits",
            "fromLink": "Maicol07/SSO/User/Traits.html", "link": "Maicol07/SSO/User/Traits/Auth.html",
            "name": "Maicol07\\SSO\\User\\Traits\\Auth",
            "doc": "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User\\Traits\\Auth", "fromLink":
                "Maicol07/SSO/User/Traits/Auth.html", "link":
                "Maicol07/SSO/User/Traits/Auth.html#method_login", "name":
                "Maicol07\\SSO\\User\\Traits\\Auth::login", "doc":
                "null"
        },
        {
            "type":
                "Method", "fromName":
                "Maicol07\\SSO\\User\\Traits\\Auth", "fromLink":
                "Maicol07/SSO/User/Traits/Auth.html", "link":
                "Maicol07/SSO/User/Traits/Auth.html#method_signup", "name":
                "Maicol07\\SSO\\User\\Traits\\Auth::signup", "doc":
                "null"
        },


        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0, -1));

        return tokens;
    }

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function (term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function (term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function (matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function (ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function (type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function (ele) {
            ele.html(treeHtml);
        }
    };

    $(function () {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function () {

    // Enable the version switcher
    $('#version-switcher').change(function () {
        window.location = $(this).val()
    });


    // Toggle left-nav divs on click
    $('#api-tree .hd span').click(function () {
        $(this).parent().parent().toggleClass('opened');
    });

    // Expand the parent namespaces of the current page.
    var expected = $('body').attr('data-name');

    if (expected) {
        // Open the currently selected node and its parents.
        var container = $('#api-tree');
        var node = $('#api-tree li[data-name="' + expected + '"]');
        // Node might not be found when simulating namespaces
        if (node.length > 0) {
            node.addClass('active').addClass('opened');
            node.parents('li').addClass('opened');
            var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
            // Position the item nearer to the top of the screen.
            scrollPos -= 200;
            container.scrollTop(scrollPos);
        }
    }


    var form = $('#search-form .typeahead');
    form.typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'search',
        displayKey: 'name',
        source: function (q, cb) {
            cb(Sami.search(q));
        }
    });

    // The selection is direct-linked when the user selects a suggestion.
    form.on('typeahead:selected', function (e, suggestion) {
        window.location = suggestion.link;
    });

    // The form is submitted when the user hits enter.
    form.keypress(function (e) {
        if (e.which == 13) {
            $('#search-form').submit();
            return true;
        }
    });


});


