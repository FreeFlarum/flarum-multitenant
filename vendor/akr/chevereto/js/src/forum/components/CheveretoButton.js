import Component from 'flarum/common/Component';
import Button from 'flarum/common/components/Button';
import classList from 'flarum/common/utils/classList';
import Tooltip from 'flarum/common/components/Tooltip';

export default class CheveretoButton extends Component {
    view() {
        const size = this.popupSize()
        return (
            <Tooltip text={app.translator.trans('akr-chevereto.forum.composer.upload_button_details')}>
                <Button
                    className={classList([
                        'Button',
                        'hasIcon',
                    ])}
                    onclick={() => {
                        window.open(app.forum.attribute('akr-chevereto.url'), Date.now()
                            , 'width=' +
                            size.w +
                            ',height=' +
                            size.h +
                            ',top=' +
                            size.t +
                            ',left=' +
                            size.l)
                    }}
                    icon={'fas fa-file-upload'}
                >
                    {app.translator.trans('akr-chevereto.forum.composer.upload_button')}
                </Button>
            </Tooltip>
        );
    }

    popupSize() {
        const client = {
            l: window.screenLeft != undefined ? window.screenLeft : screen.left,
            t: window.screenTop != undefined ? window.screenTop : screen.top,
            w: window.innerWidth
                ? window.innerWidth
                : document.documentElement.clientWidth
                    ? document.documentElement.clientWidth
                    : screen.width,
            h: window.innerHeight
                ? window.innerHeight
                : document.documentElement.clientHeight
                    ? document.documentElement.clientHeight
                    : screen.height
        };
        const size = {
            w: (720 / client.w > 0.5) ? client.w * 0.5 : 720,
            h: (690 / client.h > 0.85) ? client.h * 0.85 : 690
        };
        size.l = Math.trunc(client.w / 2 - size.w / 2 + client.l)
        size.t = Math.trunc(client.h / 2 - size.h / 2 + client.t)
        return size
    }
}
