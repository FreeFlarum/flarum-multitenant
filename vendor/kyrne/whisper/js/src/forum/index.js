import app from 'flarum/app';
import {extend} from 'flarum/extend';
import IndexPage from 'flarum/components/IndexPage';
import Message from './models/Message';
import Conversation from './models/Conversation';
import ConversationUser from './models/ConversationUser';
import User from 'flarum/models/User';
import Model from 'flarum/Model';
import ConversationsPage from './components/ConversationsPage';
import ConversationViewPage from './components/ConversationViewPage';
import Stream from 'flarum/utils/Stream';

import addConversationsDropdown from './addConversationsDropdown'

app.initializers.add('kyrne-whisper', function (app) {
  app.store.models.messages = Message;
  app.store.models.conversations = Conversation;
  app.store.models.conversation_users = ConversationUser;

  User.prototype.conversations = Model.hasMany('conversations');
  User.prototype.unreadMessages = Model.attribute('unreadMessages');

  app.routes.conversations = { path: '/whisper/conversations', component: ConversationsPage };
  app.routes.messages = { path: '/whisper/messages/:id', component: ConversationViewPage };

  addConversationsDropdown();

  extend(IndexPage.prototype, 'oncreate', function() {
    if (app.pusher) {
      app.pusher.then(object => {
        const channels = object.channels;
        if (channels.user) {
          channels.user.bind('newMessage', data => {
            app.session.user.unreadMessages = Stream(app.session.user.unreadMessages() + 1);
            m.redraw();
          });
        }
      });
    }
  })

  extend(IndexPage.prototype, 'onremove', function() {
    if (app.pusher) {
      app.pusher.then(object => {
        const channels = object.channels;
        if (channels.user) {
          channels.user.unbind('newMessage');
        }
      });
    }
  })
});
