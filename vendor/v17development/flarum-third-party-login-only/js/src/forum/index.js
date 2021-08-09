import { extend, override } from "flarum/extend";
import LogInModal from "flarum/forum/components/LogInModal";
import SignUpModal from "flarum/forum/components/SignUpModal";
import HeaderSecondary from "flarum/forum/components/HeaderSecondary";
import LogInButton from "flarum/forum/components/LogInButton";
import SettingsPage from "flarum/forum/components/SettingsPage";

app.initializers.add("v17development-flarum-third-party-login-only", (app) => {
  // Hide login form
  extend(LogInModal.prototype, "fields", function (items) {
    items.remove("identification");
    items.remove("password");
    items.remove("remember");
    items.remove("submit");
  });

  // Hide sign up form
  extend(SignUpModal.prototype, "fields", function (items) {
    // Add welcome message
    if (this.attrs.token && app.forum.attribute("signUpWelcomeText")) {
      items.add(
        "welcome-message",
        <p className={"SignUpWelcomeText"}>
          {app.forum.attribute("signUpWelcomeText")}
        </p>,
        99
      );
    }

    // Registration token
    if (!this.attrs.token) {
      items.remove("username");
      items.remove("email");
      items.remove("submit");
    }

    items.remove("password");
  });

  // Replace login footer
  override(LogInModal.prototype, "footer", function () {
    if (app.forum.attribute("forgotPasswordLink") === "") return null;

    return (
      <p className="LogInModal-forgotPassword">
        <a href={app.forum.attribute("forgotPasswordLink")} target={"_blank"}>
          {app.translator.trans("core.forum.log_in.forgot_password_link")}
        </a>
      </p>
    );
  });

  // Replace sign up button
  extend(HeaderSecondary.prototype, "items", function (items) {
    if (app.forum.attribute("replaceLoginWithFoFPassport") == false) return;

    // Replace sign up button
    if (app.forum.attribute("allowSignUp")) {
      items.replace(
        "signUp",
        LogInButton.component(
          {
            className: "Button Button--link",
            path: "/auth/passport",
          },
          app.translator.trans("core.forum.header.sign_up_link")
        )
      );
    }

    items.replace(
      "logIn",
      LogInButton.component(
        {
          className: "Button Button--link",
          path: "/auth/passport",
        },
        app.translator.trans("core.forum.header.log_in_link")
      )
    );
  });

  // Remove 'Password' button
  extend(SettingsPage.prototype, "accountItems", function (items) {
    // Replace button
    if (app.forum.attribute("changePasswordLink")) {
      items.replace(
        "changePassword",
        <a
          href={app.forum.attribute("changePasswordLink")}
          target={"_blank"}
          className="Button"
        >
          {app.translator.trans("core.forum.settings.change_password_button")}
        </a>
      );
    } else {
      items.remove("changePassword");
    }

    // Remove change mail button
    if (app.forum.attribute("allowChangeMail") == false) {
      items.remove("changeEmail");
    }
  });
});
