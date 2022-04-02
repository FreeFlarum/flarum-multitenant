import Component from 'flarum/Component';

export default class ProgressBar extends Component {
  view() {
    let className = ['UiKit-ProgressBar'];

    if (this.attrs.className) className.push(this.attrs.className);

    if (this.attrs.mini) className.push('UiKit-ProgressBar--mini');

    if (this.attrs.fancy) className.push('UiKit-ProgressBar--fancy');

    if (this.attrs.alternate) className.push('UiKit-ProgressBar--alternate');

    return (
      <div className={className.join(' ')}>
        <div className="UiKit-ProgressBar-bar" style={{ width: `${this.getProgress()}%` }} />
      </div>
    );
  }

  getProgress() {
    return this.attrs.progress;
  }
}
