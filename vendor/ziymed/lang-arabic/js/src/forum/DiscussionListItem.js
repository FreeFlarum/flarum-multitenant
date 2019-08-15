import { extend } from 'flarum/extend';
import DiscussionListItem from 'flarum/components/DiscussionListItem';

extend(DiscussionListItem.prototype, 'view', function(vdom) {

    // console.log(vdom);

    if(app.data.locale == 'ar'){

		if (vdom.children && vdom.children[2].children[0].attrs) {

			const path = vdom.children[2].children[0].attrs;

		    path.config = function(element) {

			  $(element).tooltip({placement: 'left'});
			  
			  m.route.apply(this, arguments);

			}

		}

    }
    
});