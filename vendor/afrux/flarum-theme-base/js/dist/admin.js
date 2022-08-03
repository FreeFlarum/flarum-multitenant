(()=>{var e={n:t=>{var a=t&&t.__esModule?()=>t.default:()=>t;return e.d(a,{a}),a},d:(t,a)=>{for(var n in a)e.o(a,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:a[n]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};(()=>{"use strict";e.r(t);const a=flarum.core.compat.extend;function n(){return n=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(e[n]=a[n])}return e},n.apply(this,arguments)}function s(e,t){return s=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},s(e,t)}function o(e,t){e.prototype=Object.create(t.prototype),e.prototype.constructor=e,s(e,t)}const r=flarum.core.compat["common/components/Modal"];var i=e.n(r);const c=flarum.core.compat["common/components/Button"];var l=e.n(c);const u=flarum.core.compat["common/utils/Stream"];var d=e.n(u);const p=flarum.core.compat["common/utils/extractText"];var h=e.n(p);const f=flarum.core.compat["admin/utils/saveSettings"];var v=e.n(f),g=function(e){function t(){return e.apply(this,arguments)||this}o(t,e);var a=t.prototype;return a.oninit=function(t){e.prototype.oninit.call(this,t);var a=app.data.settings["afrux-theme-base.footer_links"],n=(a&&JSON.parse(a)||[]).filter((function(e){return null!==e})).map((function(e){return e.links&&(e.links=e.links.filter((function(e){return null!==e}))),e}));this.links=d()(n),this.loading=d()(!1)},a.title=function(){return app.translator.trans("afrux-theme-base.admin.settings.edit_footer_links")},a.className=function(){return"EditFooterLinksModal Modal--medium"},a.content=function(){var e=this;return m("div",{className:"EditFooterLinksModal-groups Modal-body"},this.links().map((function(t,a){return m("div",{className:"EditFooterLinksModal-groups-item"},m("div",{className:"EditFooterLinksModal-groups-item-title"},m("div",{className:"EditFooterLinksModal-groups-item-title-text",contenteditable:"true",oninput:function(s){e.saveGroup(n({},t,{title:s.target.innerHTML}),a)}},m.trust(t.title)),m("div",{className:"EditFooterLinksModal-groups-item-title-controls"},m(l(),{className:"Button Button--icon",icon:"fas fa-times",onclick:function(){e.saveGroup(t,a,!0)}}))),m("div",{className:"EditFooterLinksModal-links"},t.links.map((function(t,n){return e.link(t,n,a)})),m(l(),{className:"Button",icon:"fas fa-plus",onclick:function(){e.saveLink({url:"",label:""},a)}},app.translator.trans("afrux-theme-base.admin.settings.links_modal.add_link"))))})),m("div",null,m(l(),{className:"Button Button--primary",loading:this.loading(),onclick:function(){v()({"afrux-theme-base.footer_links":JSON.stringify(e.links())}).then((function(){e.loading(!1),app.modal.close()})),e.loading(!0)}},app.translator.trans("core.lib.edit_user.submit_button")),m(l(),{className:"Button",icon:"fas fa-plus-circle",onclick:function(){e.saveGroup({title:h()(app.translator.trans("afrux-theme-base.admin.settings.links_modal.group_name",{number:e.links().length+1})),links:[]})}},app.translator.trans("afrux-theme-base.admin.settings.links_modal.add_group"))))},a.link=function(e,t,a){var n=this,s=e.url,o=e.label;return[].concat(this.links()),m("div",{className:"EditFooterLinksModal-links-item"},m("input",{oninput:function(e){n.saveLink({url:s,label:e.target.value},a,t)},value:o,className:"FormControl EditFooterLinksModal-links-item-label",placeholder:app.translator.trans("afrux-theme-base.admin.settings.links_modal.link_label"),"aria-labeledby":app.translator.trans("afrux-theme-base.admin.settings.links_modal.link_label")}),m("input",{oninput:function(e){n.saveLink({label:o,url:e.target.value},a,t)},value:s,className:"FormControl EditFooterLinksModal-links-item-url",placeholder:app.translator.trans("afrux-theme-base.admin.settings.links_modal.link_url"),"aria-labeledby":app.translator.trans("afrux-theme-base.admin.settings.links_modal.link_url")}),m(l(),{className:"Button Button--icon",icon:"fas fa-times",onclick:function(){n.saveLink({},a,t,!0)}}))},a.saveLink=function(e,t,a,n){void 0===a&&(a=null),void 0===n&&(n=!1);var s=[].concat(this.links());n?delete s[t].links[a]:null!==a?s[t].links[a]=e:s[t].links.push(e),s[t].links=s[t].links.filter((function(e){return null!==e})),this.links(s)},a.saveGroup=function(e,t,a){void 0===t&&(t=null),void 0===a&&(a=!1);var n=[].concat(this.links());a?delete n[t]:null!==t?n[t]=e:n.push(e),n=n.filter((function(e){return null!==e})),this.links(n)},t}(i());const x=flarum.core.compat["admin/components/StatusWidget"];var b=e.n(x);const N=flarum.core.compat["admin/components/ExtensionsWidget"];var k=e.n(N);const y=flarum.core.compat["admin/components/HeaderSecondary"];var B=e.n(y);const E=flarum.core.compat["admin/components/AdminHeader"];var _=e.n(E);const T=flarum.core.compat["admin/components/ExtensionPage"];var P=e.n(T);const L=flarum.core.compat["admin/components/UserListPage"];var S=e.n(L);const A=flarum.core.compat["common/utils/classList"];var w=e.n(A);const C=flarum.core.compat["common/helpers/icon"];var H=e.n(C);const I=flarum.core.compat["common/helpers/listItems"];var U=e.n(I);const F=flarum.core.compat["common/helpers/avatar"];var M=e.n(F);const O=flarum.core.compat["common/helpers/username"];var j=e.n(O);const z=flarum.core.compat["admin/components/AdminNav"];var D=e.n(z);const W=flarum.core.compat["common/components/SelectDropdown"];var G=e.n(W);const q=flarum.core.compat["common/components/LinkButton"];var J=e.n(q);const V=flarum.core.compat["admin/components/DashboardPage"];var K=e.n(V);const Q=flarum.core.compat["common/components/Navigation"];var R=e.n(Q);const X=flarum.core.compat["common/components/Dropdown"];var Y=e.n(X);const Z=flarum.core.compat["common/components/Switch"];var ee=e.n(Z),te=function(e){function t(){return e.apply(this,arguments)||this}o(t,e);var a=t.prototype;return a.oninit=function(){app.current.data.extension=this.extension.extra["flarum-extension"].title},a.header=function(){var e=this.topItems();return e.get("version").attrs.className+=" TagLabel",m("div",{className:"ExtensionPage-header ThemeBase-AdminHeader"},m("div",{className:"ThemeBase-AdminHeader-container"},m("span",{className:"ThemeBase-AdminHeader-icon",style:this.extension.icon},this.extension.icon?H()(this.extension.icon.name):""),m("div",{className:"ThemeBase-AdminHeader-info"},m("h2",{className:"ThemeBase-AdminHeader-title"},this.extension.extra["flarum-extension"].title),m("div",{className:"ThemeBase-AdminHeader-description helpText"},this.extension.description)),m("div",{className:"ExtensionPage-headerTopItems"},m("ul",null,U()(e.toArray())))))},a.view=function(){var e=this;if(!this.extension)return null;var t=this.sections(),a=this.infoItems();return this.activeSection=this.activeSection||"content",t.items.permissions&&(t.items.permissions.content[0]=t.items.permissions.content[0].children[1].children),m("div",{className:"ExtensionPage ThemeBase-ExtensionPage "+this.className()},this.header(),m("div",{className:"ExtensionPage-body ThemeBase-ExtensionPage-body"},m("div",{className:"container"},m("div",{className:"ExtensionPage-headerItems ThemeBase-ExtensionPage-headerItems"},m(ee(),{state:this.isEnabled(),onchange:this.toggle.bind(this,this.extension.id)},this.isEnabled(this.extension.id)?app.translator.trans("core.admin.extension.enabled"):app.translator.trans("core.admin.extension.disabled")),m("aside",{className:"ThemeBase-ExtensionPage-ExtensionInfo"},m("ul",null,U()(a.toArray())))),m("div",{className:"ExtensionPage-sections-nav ThemeBase-ExtensionPage-sections-nav"},Object.keys(t.items).map((function(t){var a="afrux-theme-base.admin.extension.sections."+t;return m(l(),{className:["Button ExtensionPage-sections-nav-item ThemeBase-ExtensionPage-sections-nav-item",e.activeSection===t?"Button--active":""],onclick:function(){return e.activeSection=t}},app.translator.trans(a)===a?t:app.translator.trans(a))}))),m("div",{className:"ExtensionPage-sections ThemeBase-ExtensionPage-sections"},Object.keys(t.items).map((function(a){var n=t.items[a].content;return n.attrs&&n.attrs.className&&(n.attrs.className=n.attrs.className.replace("ExtensionPage","ThemeBase-ExtensionPage")),m("div",{className:["ExtensionPage-section ThemeBase-ExtensionPage-section",e.activeSection===a?"ExtensionPage-section--active ThemeBase-ExtensionPage-section--active":""].join(" ")},t.items[a].content)}))))))},a.content=function(e){return this.isEnabled()?e():m("div",{className:"ThemeBase-infobox"},app.translator.trans("core.admin.extension.enable_to_see"))},t}(P());const ae=flarum.core.compat["admin/components/AdminPage"];var ne=e.n(ae);const se=flarum.core.compat["admin/utils/getCategorizedExtensions"];var oe=e.n(se);const re=flarum.core.compat["admin/utils/isExtensionEnabled"];var ie=e.n(re);const me=flarum.core.compat["common/components/Link"];var ce=e.n(me),le=function(e){function t(){return e.apply(this,arguments)||this}o(t,e);var a=t.prototype;return a.oninit=function(t){e.prototype.oninit.call(this,t),this.extensions=app.categorizedExtensions||oe()()},a.headerInfo=function(){return{className:"ThemeBase-ExtensionsPage",icon:"fas fa-puzzle-piece",title:app.translator.trans("afrux-theme-base.admin.extensions.title"),description:app.translator.trans("afrux-theme-base.admin.extensions.description")}},a.content=function(){var e=this;return m("div",{className:"ThemeBase-ExtensionCategories"},m("div",{className:"ThemeBase-ExtensionCategories-container"},Object.keys(this.extensions).map((function(t){return m("div",{className:"ThemeBase-ExtensionCategory"},m("h3",{className:"ThemeBase-ExtensionCategory-title"},app.categoryLabels&&app.categoryLabels[t]||app.translator.trans("core.admin.nav.categories."+t)),m("div",{className:"ThemeBase-ExtensionCategory-container"},e.extensions[t].map((function(e){return m(ce(),{href:app.route("extension",{id:e.id}),className:"ThemeBase-Extension"},m("div",{className:"ThemeBase-Extension-icon"},m("span",{className:"ExtensionListItem-icon ExtensionIcon",style:e.icon},e.icon?H()(e.icon.name):"")),m("div",{className:"ThemeBase-Extension-content"},m("div",{className:"ThemeBase-Extension-title"},m("div",{className:["ExtensionListItem-Dot","ThemeBase-Extension-state",ie()(e.id)?"enabled":"disabled"].join(" ")}),m("div",{className:"ThemeBase-Extension-title-value"},e.extra["flarum-extension"].title)),m("div",{className:"ThemeBase-Extension-details"},m("div",{className:"ThemeBase-Extension-package"},e.name),m("div",{className:"ThemeBase-Extension-version"},e.version))))}))))}))))},t}(ne()),ue=function(e){function t(){for(var t,a=arguments.length,n=new Array(a),s=0;s<a;s++)n[s]=arguments[s];return(t=e.call.apply(e,[this].concat(n))||this).loading=!1,t}o(t,e);var a=t.prototype;return a.view=function(t){return this.attrs.loading=this.loading,this.attrs.className=(this.attrs.className||"")+" Button",app.data.settings[this.attrs.setting]?(this.attrs.onclick=this.remove.bind(this),m("div",{className:"UploadImageButton-container"},m("div",{className:"UploadImageButton-image-container"},m("img",{className:"UploadImageButton-image",src:app.forum.attribute(this.attrs.serializedName),alt:""})),e.prototype.view.call(this,n({},t,{children:app.translator.trans("core.admin.upload_image.remove_button")})))):(this.attrs.onclick=this.upload.bind(this),e.prototype.view.call(this,n({},t,{children:app.translator.trans("core.admin.upload_image.upload_button")})))},a.upload=function(){var e=this;this.loading||$('<input type="file">').appendTo("body").hide().click().on("change",(function(t){var a=new FormData;a.append(e.attrs.name,$(t.target)[0].files[0]),e.loading=!0,m.redraw(),app.request({method:"POST",url:e.resourceUrl(),serialize:function(e){return e},body:a}).then(e.success.bind(e),e.failure.bind(e))}))},a.remove=function(){this.loading=!0,m.redraw(),app.request({method:"DELETE",url:this.resourceUrl()}).then(this.success.bind(this),this.failure.bind(this))},a.resourceUrl=function(){return app.forum.attribute("apiUrl")+"/"+this.attrs.routeName},a.success=function(e){window.location.reload()},a.failure=function(e){this.loading=!1,m.redraw()},t}(l());const de={"extensions/afrux-theme-base/admin/components/EditFooterLinksModal":g,"extensions/afrux-theme-base/admin/components/ExtensionPage":te,"extensions/afrux-theme-base/admin/components/ExtensionsPage":le,"extensions/afrux-theme-base/admin/components/UploadImageButton":ue},pe=flarum.core;app.initializers.add("afrux-theme-base",(function(){var e=app.data.resources[0].attributes["afrux-theme-base.footerHooked"],t=app.data.resources[0].attributes["afrux-theme-base.bannerHooked"],n=app.data.resources[0].attributes.currentThemeId,s=app.data.resources[0].attributes["afrux-theme-base.normalizeStatusWidgetStructure"],o=app.data.resources[0].attributes["afrux-theme-base.normalizeAdminHeaderStructure"],r=app.data.resources[0].attributes["afrux-theme-base.normalizeExtensionPageStructure"],i=app.data.resources[0].attributes["afrux-theme-base.normalizeUserTable"],c=app.data.resources[0].attributes["afrux-theme-base.addExtensionsPage"];t&&app.extensionData.for(n).registerSetting((function(){return m("div",{className:"Form-group HeroImageForm"},m("label",{for:"afrux-theme-base.hero_banner"},app.translator.trans("afrux-theme-base.admin.settings.hero_banner")),m(ue,{setting:"afrux-theme-base.hero_banner",serializedName:"afruxHeroBanner",routeName:"afrux_banner",name:"afrux_banner"}))})).registerSetting({setting:"afrux-theme-base.hero_banner_position",type:"text",label:app.translator.trans("afrux-theme-base.admin.settings.hero_banner_position")}),e&&app.extensionData.for(n).registerSetting((function(){return m("div",{className:"Form-group"},m("label",null,app.translator.trans("afrux-theme-base.admin.settings.footer_description")),m("textarea",{className:"FormControl",bidi:this.setting("afrux-theme-base.footer_description")},this.setting("afrux-theme-base.footer_description")()))})).registerSetting((function(){return m("div",{className:"Form-group"},m("label",null,app.translator.trans("afrux-theme-base.admin.settings.edit_footer_links")),m(l(),{className:"Button",onclick:function(){return app.modal.show(g)}},app.translator.trans("afrux-theme-base.admin.settings.edit_footer_links")))})).registerSetting({setting:"afrux-theme-base.footer_bottom_line",type:"text",label:app.translator.trans("afrux-theme-base.admin.settings.footer_bottom_line")}),s&&((0,a.override)(b().prototype,"className",(function(e){return e()+" ThemeBase-StatusWidget"})),(0,a.override)(b().prototype,"content",(function(e){var t=this.items();t.remove("tools");var a={"version-flarum":"fas fa-comment","version-php":"fab fa-php","version-mysql":"fas fa-database"};return app.data.illuminateVersion&&(a["version-laravel"]="fab fa-laravel",t.add("version-laravel",[m("strong",null,"Laravel"),m("br",null),app.data.illuminateVersion.replace("v","")])),Object.keys(t.items).map((function(e){var n=t.get(e);n[0].tag="div",n[0].attrs.className="ThemeBase-StatusWidget-key",n[2]=m("div",{className:"ThemeBase-StatusWidget-value"},n[2]),n[1]=m("div",{className:"ThemeBase-StatusWidget-content"},[n[0],n[2]]),n[0]=m("div",{className:"ThemeBase-StatusWidget-icon"},H()(a[e])),delete n[2]})),[m("ul",null,U()(t.toArray()))]}))),o&&((0,a.override)(_().prototype,"view",(function(e,t){var a=this;switch(this.attrs.className){case"DashboardPage-header":this.handleClearCache=b().prototype.handleClearCache,this.controls=function(){return m(Y(),{label:app.translator.trans("core.admin.dashboard.tools_button"),icon:"fas fa-cog",buttonClassName:"Button",menuClassName:"Dropdown-menu--right"},m(l(),{onclick:a.handleClearCache.bind(a)},app.translator.trans("core.admin.dashboard.clear_cache_button")))};break;case"ThemeBase-ExtensionsPage-header":c&&k().prototype.controlItems&&(this.controls=function(){var e=k().prototype.controlItems().toArray()[0].children;return e[0].attrs.menuClassName+=" Dropdown-menu--right",e})}return m("div",{className:w()(["ThemeBase-AdminHeader",this.attrs.className])},m("div",{className:"container ThemeBase-AdminHeader-container"},m("div",{className:"ThemeBase-AdminHeader-icon"},H()(this.attrs.icon)),m("div",{className:"ThemeBase-AdminHeader-info"},m("h2",{className:"ThemeBase-AdminHeader-title"},t.children),m("div",{className:"ThemeBase-AdminHeader-description"},this.attrs.description)),m("div",{className:"ThemeBase-AdminHeader-controls"},this.controls&&this.controls())))})),(0,a.override)(P().prototype,"header",te.prototype.header)),r&&((0,a.override)(P().prototype,"view",te.prototype.view),(0,a.override)(P().prototype,"content",te.prototype.content)),i&&((0,a.extend)(S().prototype,"columns",(function(e){e.add("avatar",{name:H()("fas fa-user-circle"),content:function(e){return M()(e,{className:"UserListPage-grid-avatar"})}},95),e.remove("username"),e.add("username",{name:app.translator.trans("core.admin.users.grid.columns.username.title"),content:function(e){var t=j()(e),a=e.username();return console.log(t,a),a===t.text?a:[a," (",t,")"]}},90);var t=e.get("joinDate");t.name=[H()("fas fa-clock")," ",t.name];var a=e.get("emailAddress");a.name=[H()("far fa-envelope")," ",a.name],e.add("profileLink",{name:"",content:function(e){return m("a",{className:"Button Button--icon UserList-profileLinkBtn",href:app.forum.attribute("baseUrl")+"/u/"+e.slug()},H()("fas fa-link"))}})})),(0,a.extend)(S().prototype,"onupdate",(function(e){this.$(".UserList-emailIconBtn").removeClass("Button--text")})),(0,a.extend)(S().prototype,"content",(function(e){e[0]=m("div",{className:"UserListPage-stat-container"},m("div",{class:"UserListPage-totalUsers UserListPage-stat"},m("div",{className:"UserListPage-stat-value"},this.userCount),m("div",{className:"UserListPage-stat-key"},app.translator.trans("core.admin.users.total_users",{count:0})[0].replace(": ",""))))}))),c&&(app.routes.extensions={path:"/extensions",component:le},(0,a.override)(D().prototype,"view",(function(){var e=this.items();return e.remove("search"),e.remove("category-core"),e.add("extensions",m(J(),{href:app.route("extensions"),icon:"fas fa-puzzle-piece",title:app.translator.trans("afrux-theme-base.admin.extensions.title"),active:["extension","extensions"].includes(app.current.data.routeName)},m("span",null,app.translator.trans("afrux-theme-base.admin.extensions.title")),app.current.data.extension?m("span",{className:"ThemeBase-extensions-nav-current"},app.current.data.extension):[])),m(G(),{className:"AdminNav App-titleControl AdminNav-Main",buttonClassName:"Button"},e.toArray().concat())})),(0,a.extend)(K().prototype,"availableWidgets",(function(e){e.remove("extensions")})),(0,a.extend)(R().prototype,"getBackButton",(function(e){return e.attrs.className=e.attrs.className.replace("Button--icon",""),"extension"===app.current.data.routeName?(e.attrs.href=app.route("extensions"),delete e.attrs.onclick,e.children=app.translator.trans("afrux-theme-base.admin.extensions.title")):e.children=app.translator.trans("afrux-theme-base.admin.header.go_back"),e}))),(0,a.extend)(P().prototype,"oninit",te.prototype.oninit),(0,a.extend)(B().prototype,"items",(function(e){e.get("help").attrs.className="Button Button--link"}))})),Object.assign(pe.compat,de)})(),module.exports=t})();
//# sourceMappingURL=admin.js.map