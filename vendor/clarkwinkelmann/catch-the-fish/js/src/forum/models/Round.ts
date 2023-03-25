import Model from 'flarum/common/Model';
import Ranking from './Ranking';

export default class Round extends Model {
    name = Model.attribute('name');
    starts_at = Model.attribute('starts_at');
    ends_at = Model.attribute('ends_at');
    include_starting_pack = Model.attribute<boolean>('include_starting_pack');
    myRanking = Model.hasOne<Ranking>('myRanking');

    apiEndpoint() {
        return '/catch-the-fish/rounds' + (this.exists ? '/' + this.data.id : '');
    }
}
