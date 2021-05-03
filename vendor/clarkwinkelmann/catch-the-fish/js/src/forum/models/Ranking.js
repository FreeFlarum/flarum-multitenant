import Model from 'flarum/common/Model';

export default class Ranking extends Model {
    catch_count = Model.attribute('catch_count');
    user = Model.hasOne('user');
}
