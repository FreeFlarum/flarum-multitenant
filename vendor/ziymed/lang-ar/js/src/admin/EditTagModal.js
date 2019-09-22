import { extend } from 'flarum/extend';
import EditTagModal from 'flarum/tags/components/EditTagModal';
import { slug } from '../common/string';

extend(EditTagModal.prototype, 'fields', function(items) {

	// console.log(items);

	items.add('name', <div className="Form-group">
      <label>{app.translator.trans('flarum-tags.admin.edit_tag.name_label')}</label>
      <input className="FormControl" placeholder={app.translator.trans('flarum-tags.admin.edit_tag.name_placeholder')} value={this.name()} oninput={e => {
        this.name(e.target.value);
        this.slug(slug(e.target.value));
      }}/>
    </div>, 50);

    items.add('slug', <div className="Form-group">
      <label>{app.translator.trans('flarum-tags.admin.edit_tag.slug_label')}</label>
      <input className="FormControl" value={this.slug()} oninput={m.withAttr('value', this.slug)}/>
    </div>, 40);
    
});