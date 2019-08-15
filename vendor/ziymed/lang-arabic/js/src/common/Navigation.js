import { extend } from 'flarum/extend';
import Navigation from 'flarum/components/Navigation';

extend(Navigation.prototype, 'getBackButton', function(vdom) {

    // console.log(app.data.locale);

    if(app.data.locale == 'ar'){

		if (vdom.props) {

	        vdom.props.icon = 'fas fa-chevron-right';

	    }    

    }

});