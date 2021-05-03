import Model from 'flarum/common/Model';

export default class Round extends Model {
    name = Model.attribute('name');
    starts_at = Model.attribute('starts_at');
    ends_at = Model.attribute('ends_at');
    include_starting_pack = Model.attribute('include_starting_pack');
    ranking = Model.hasOne('ranking');

    apiEndpoint() {
        return '/catch-the-fish/rounds' + (this.exists ? '/' + this.data.id : '');
    }
}
