import Model from 'flarum/Model';

export default class Message extends Model {}

Object.assign(Message.prototype, {
    message: Model.attribute('message'),
    user: Model.hasOne('user'),
    deleted_by: Model.hasOne('deleted_by'),
    chat: Model.hasOne('chat'),
    created_at: Model.attribute('created_at', Model.transformDate),
    edited_at: Model.attribute('edited_at', Model.transformDate),
    type: Model.attribute('type'),
    is_readed: Model.attribute('is_readed'),
    ip_address: Model.attribute('ip_address'),
    is_censored: Model.attribute('is_censored'),
});
