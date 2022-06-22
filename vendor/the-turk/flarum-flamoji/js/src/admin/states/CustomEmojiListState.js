import app from 'flarum/common/app';

export default class CustomEmojiListState {
  constructor() {
    this.emojis = [];

    this.moreResults = false;

    this.loading = false;
  }

  /**
   * Load more custom emojis
   *
   * @param offset The index to start the page at.
   */
  loadResults(offset = 0) {
    this.loading = true;

    return app.store.find('the-turk/emojis', { page: { limit: 23, offset } }).then(this.parseResults.bind(this));
  }

  /**
   * Load the next page of emoji results.
   */
  loadMore() {
    this.loading = true;

    this.loadResults(this.emojis.length);
  }

  /**
   * Parse results and append them to the emoji list.
   */
  parseResults(results) {
    this.emojis.push(...results);

    this.loading = false;
    this.moreResults = !!results.payload.links && !!results.payload.links.next;

    m.redraw();

    return results;
  }

  /**
   * Add an emoji to the beginning of the list
   */
  addToList(emoji) {
    this.loading = true;

    this.emojis.unshift(emoji);

    this.loading = false;
  }

  /**
   * Remove an emoji from the list
   */
  removeFromList(emojiId) {
    this.loading = true;

    const index = this.emojis.findIndex((emoji) => emojiId === emoji.id());
    this.emojis.splice(index, 1);

    this.loading = false;
  }

  /**
   * Are there any emojis in the list?
   */
  hasEmojis() {
    return this.emojis.length > 0;
  }

  /**
   * Is the emoji list loading?
   */
  isLoading() {
    return this.loading;
  }

  /**
   * Does this list has more emojis?
   */
  hasMoreResults() {
    return this.moreResults;
  }

  /**
   * Does this list have any emojis?
   */
  empty() {
    return !this.hasEmojis() && !this.isLoading();
  }
}
