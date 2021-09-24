import Component from 'flarum/common/Component';

export default class SuggestionButton extends Component {
    view() {
        const attrs = this.attrs.attributes;

        const title = attrs.title;
        const url = attrs.url;
        const icon = attrs.icon;
        const onclick = attrs.onclick;

        return (
            <div style={url && `background-image: url(${url})`} onclick={onclick}>
                {icon && <i class={icon}></i>} {title}
            </div>
        );
    }
}
