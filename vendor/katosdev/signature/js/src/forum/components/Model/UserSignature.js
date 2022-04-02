import Model from 'flarum/Model';
import User from 'flarum/models/User';

export default class UserSignature {
    constructor(userSession) {
        User.prototype.signature = Model.attribute('signature');
        this._userdata = userSession;
    }

    getSignature() {
        return this._userdata.attribute('signature');
    }

    setSignature(signature) {
        return this._userdata.save({ signature: signature });
    }
}
