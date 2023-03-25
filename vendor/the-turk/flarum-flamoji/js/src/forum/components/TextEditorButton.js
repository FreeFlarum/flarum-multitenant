import Button from 'flarum/common/components/Button';
import Tooltip from 'flarum/common/components/Tooltip';

/**
 * The `TextEditorButton` component displays a button suitable for the text
 * editor toolbar.
 *
 * So this class is only here because of
 * to set `showOnFocus={false}` on the tooltip.
 */
export default class TextEditorButton extends Button {
  view(vnode) {
    const originalView = super.view(vnode);

    // Steal tooltip label from the Button superclass
    const tooltipText = this.attrs.tooltipText || originalView.attrs.title;
    delete originalView.attrs.title;

    return (
      <Tooltip showOnFocus={false} text={tooltipText}>
        {originalView}
      </Tooltip>
    );
  }

  static initAttrs(attrs) {
    super.initAttrs(attrs);

    attrs.className = 'Button Button--icon Button--link Button-flamoji';
    attrs.tooltipText = attrs.title;
  }
}
