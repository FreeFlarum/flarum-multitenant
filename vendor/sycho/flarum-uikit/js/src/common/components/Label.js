import Component from 'flarum/Component';

export default class Label extends Component {
  view(vnode) {
    let style = {};
    let className = ['UiKit-Label'];

    if (this.attrs.className) className.push(this.attrs.className);

    if (this.attrs.color) {
      style.backgroundColor = `#${this.attrs.color}`;
      className.push('colored');
    }

    return (
      <span className={className.join(' ')} style={style}>
        <span className="UiKit-Label-text">{vnode.children}</span>
      </span>
    );
  }
}
