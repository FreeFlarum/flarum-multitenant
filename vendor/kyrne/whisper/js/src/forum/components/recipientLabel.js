import extract from 'flarum/utils/extract';
import avatar from 'flarum/helpers/avatar';
import username from 'flarum/helpers/username';


export default function recipientLabel(recipient, attrs = {}) {
  attrs.style = attrs.style || {};
  attrs.className = 'RecipientLabel ' + (attrs.className || '');

  const link = extract(attrs, 'link');

  return (
    m((link ? 'a' : 'span'), attrs,
      <span className="RecipientLabel-text">
                {avatar(recipient)}
              {username(recipient)}
        </span>
    )
  );
}