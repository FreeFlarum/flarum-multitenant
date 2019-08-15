import app from 'flarum/app';
import 'cookieconsent';

app.initializers.add('reflar-cookie-consent', () => {
    $(document).ready(() => {
        const ccTheme = app.forum.attribute('reflar-cookie-consent.ccTheme');
        const backgroundColor = app.forum.attribute('reflar-cookie-consent.backgroundColor');
        const textColor = app.forum.attribute('reflar-cookie-consent.textColor');
        const consentText = app.forum.attribute('reflar-cookie-consent.consentText');
        const buttonText = app.forum.attribute('reflar-cookie-consent.buttonText');
        const buttonBackgroundColor = app.forum.attribute('reflar-cookie-consent.buttonBackgroundColor');
        const buttonTextColor = app.forum.attribute('reflar-cookie-consent.buttonTextColor');
        const learnMoreLinkText = app.forum.attribute('reflar-cookie-consent.learnMoreLinkText');
        const learnMoreLinkUrl = app.forum.attribute('reflar-cookie-consent.learnMoreLinkUrl');

        const popup = {};
        const button = {};

        if (backgroundColor) popup.background = backgroundColor;
        if (textColor) popup.text = textColor;

        if (buttonBackgroundColor) button.background = buttonBackgroundColor;
        if (buttonTextColor) button.text = buttonTextColor;

        try {
            const settings = {
                palette: {
                    popup,
                    button,
                },
                theme: ccTheme,
                content: {
                    message: consentText,
                    dismiss: buttonText,
                    link: learnMoreLinkText,
                    href: learnMoreLinkUrl,
                },
            };

            cookieconsent.initialise(settings);
        } catch (err) {
            if (app.forum.attribute('adminUrl')) {
                console.error('An error occurred initializing the Cookie Consent library. Please make sure you have set all the settings properly.');
                console.error("Please report the following error if you don't think the issue is on your end\n\n", err);
            } else {
                console.error('An error occurred with the cookie consent prompt. Please contact an administrator so they can fix the issue.');
            }
        }

        delete window.cookieconsent;
    });
});
