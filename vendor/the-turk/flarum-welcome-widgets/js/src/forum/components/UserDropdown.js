import Dropdown from 'flarum/components/Dropdown';
import SessionDropdown from 'flarum/components/SessionDropdown';

/**
 * The `UserDropdown` component shows a dropdown of session controls.
 */
export default class UserDropdown extends Dropdown {
  static initProps(props) {
    super.initProps(props);

    props.icon = 'fas fa-ellipsis-v';
    props.className = 'IndexPage-stats-dropdown';
    props.buttonClassName = 'Button Button--icon Button--flat';
  }

  view() {
    this.props.children = SessionDropdown.prototype.items().toArray();

    return super.view();
  }
}
