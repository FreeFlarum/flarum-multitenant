import Button from 'flarum/common/components/Button';
import Component from 'flarum/common/Component';
import EditEmojiModal from './EditEmojiModal';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import urlChecker from '../../common/utils/urlChecker';

export default class CustomEmojiList extends Component {
  oninit(vnode) {
    super.oninit(vnode);

    app.customEmojiListState.loadResults();
  }

  view() {
    const state = app.customEmojiListState;

    return (
      <div className="customEmoji-list">
        {/* Loading */}
        {state.isLoading() && state.emojis.length === 0 ? <LoadingIndicator display="unset" size="large" /> : ''}

        {/* Emoji list */}
        <ul>
          {state.emojis.map((emoji) => {
            const url = urlChecker(emoji.path()) ? emoji.path() : app.forum.attribute('baseUrl') + emoji.path();

            return (
              <li>
                <div class="customEmoji">
                  <Button
                    className="Button Button--icon customEmoji-editButton"
                    icon="fas fa-pencil-alt"
                    onclick={() => app.modal.show(EditEmojiModal, { model: emoji })}
                  />
                  <div className="customEmoji-imageWrapper">
                    <img src={url} className="customEmoji-image" alt={emoji.title()} title={emoji.textToReplace()} />
                  </div>
                  <div className="customEmoji-title">
                    <h4>{emoji.title()}</h4>
                  </div>
                </div>
              </li>
            );
          })}
          <li>
            <div class="customEmoji addEmoji">
              <div className="customEmoji-imageWrapper">
                <Button className="Button Button--icon customEmoji-addButton" icon="fas fa-plus" onclick={() => app.modal.show(EditEmojiModal)} />
              </div>
            </div>
          </li>
        </ul>

        {/* Load more files */}
        {state.hasMoreResults() && (
          <div className="customEmoji-loadMore">
            <Button className="Button Button--primary" disabled={state.isLoading()} loading={state.isLoading()} onclick={() => state.loadMore()}>
              {app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.emoji_list.load_more_button')}
            </Button>
          </div>
        )}
      </div>
    );
  }
}
