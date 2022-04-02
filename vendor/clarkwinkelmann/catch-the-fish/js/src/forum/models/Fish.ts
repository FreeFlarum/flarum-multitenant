import Model from 'flarum/common/Model';
import User from 'flarum/common/models/User';
import Discussion from 'flarum/common/models/Discussion';
import Post from 'flarum/common/models/Post';
import Round from './Round';

export default class Fish extends Model {
    round_id = Model.attribute('round_id'); // Just for the creation apiEndpoint creation
    placement = Model.attribute('placement'); // Object
    name = Model.attribute<string>('name');
    image_url = Model.attribute<string>('image_url');
    canSee = Model.attribute<boolean>('canSee');
    canCatch = Model.attribute<boolean>('canCatch');
    canName = Model.attribute<boolean>('canName');
    canPlace = Model.attribute<boolean>('canPlace');
    placeUntil = Model.attribute('placeUntil');
    namedBy = Model.hasOne<User>('lastUserNaming');
    placedBy = Model.hasOne<User>('lastUserPlacement');
    round = Model.hasOne<Round>('round');
    placementModel = Model.hasOne<User | Discussion | Post>('placement'); // Only used by the admin panel to show the link to the resource

    apiEndpoint() {
        return '/catch-the-fish/' + (this.exists ? 'fishes/' + this.data.id : 'rounds/' + this.data.attributes.round_id + '/fishes');
    }
}
