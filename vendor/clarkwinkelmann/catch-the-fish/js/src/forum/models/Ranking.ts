import Model from 'flarum/common/Model';
import User from 'flarum/common/models/User';

export default class Ranking extends Model {
    catch_count = Model.attribute('catch_count');
    user: () => User = Model.hasOne('user');
}
