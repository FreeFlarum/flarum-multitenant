import Model from 'flarum/common/Model';
import User from 'flarum/common/models/User';

export default class Fish extends Model {
    round_id = Model.attribute('round_id'); // Just for the creation apiEndpoint creation
    placement = Model.attribute('placement'); // Object
    name = Model.attribute('name');
    image_url = Model.attribute('image_url');
    canSee = Model.attribute('canSee');
    canCatch = Model.attribute('canCatch');
    canName = Model.attribute('canName');
    canPlace = Model.attribute('canPlace');
    placeUntil = Model.attribute('placeUntil');
    namedBy: () => User | false = Model.hasOne('lastUserNaming');
    placedBy: () => User | false = Model.hasOne('lastUserPlacement');
    round = Model.hasOne('round');
    placementModel = Model.hasOne('placement'); // Only used by the admin panel to show the link to the resource

    apiEndpoint() {
        return '/catch-the-fish/' + (this.exists ? 'fishes/' + this.data.id : 'rounds/' + this.data.attributes.round_id + '/fishes');
    }
}
