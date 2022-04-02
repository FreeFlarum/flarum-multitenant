import Component from 'flarum/Component';
import icon from 'flarum/helpers/icon';

export default class Input extends Component {
  view() {
    this.attrs.className = this.attrs.className || '';

    this.attrs.className += ' UiKit-FormControl';

    if (this.attrs.icon) {
      this.attrs.className += ' hasIcon';
    }

    let className = `UiKit-Input ${this.attrs.parentClassName || ''}`;

    return (
      <div className={className}>
        {this.icon()}
        <input {...this.attrs} />
      </div>
    );
  }

  icon() {
    if (!this.attrs.icon) return;

    const iconValue = this.attrs.icon;

    delete this.attrs.icon;

    return <span class="UiKit-Input-icon">{icon(iconValue)}</span>;
  }
}
