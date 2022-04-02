import app from "flarum/common/app";

app.initializers.add("the-turk-quiet-edits", (app) => {
  app.extensionData
    .for("the-turk-quiet-edits")
    .registerSetting({
      setting: "the-turk-quiet-edits.grace_period",
      type: "number",
      label: app.translator.trans(
        "the-turk-quiet-edits.admin.settings.grace_period_label"
      ),
      help: app.translator.trans(
        "the-turk-quiet-edits.admin.settings.grace_period_text"
      ),
    })
    .registerSetting({
      setting: "the-turk-quiet-edits.ignore_case_differences",
      type: "boolean",
      label: app.translator.trans(
        "the-turk-quiet-edits.admin.settings.ignore_case_differences_label"
      ),
    })
    .registerSetting({
      setting: "the-turk-quiet-edits.ignore_whitespace_differences",
      type: "boolean",
      label: app.translator.trans(
        "the-turk-quiet-edits.admin.settings.ignore_whitespace_differences_label"
      ),
    });
});
