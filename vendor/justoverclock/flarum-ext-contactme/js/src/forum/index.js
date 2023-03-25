/*
 *  Contact Us Extension for Flarum
 *  Author: Marco Colia
 *  Website: https://flarum.it
 *
 *  Special Thanks to Askvortsov
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:

 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.

 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 */

import { extend } from "flarum/extend";
import IndexPage from "flarum/components/IndexPage";
import LinkButton from "flarum/components/LinkButton";
import ContactPage from "./components/ContactPage";

app.initializers.add("justoverclock/flarum-ext-contactme", () => {});

app.routes.contactPage = {
  path: "/contact-us",
  component: ContactPage,
};
extend(IndexPage.prototype, "navItems", (navItems) => {
  navItems.add(
    "contactPage",
    <LinkButton href={app.route("contactPage")} icon="fas fa-at">
      {app.translator.trans("flarum-ext-contactme.forum.title")}
    </LinkButton>,
    100
  );

  return navItems;
});
