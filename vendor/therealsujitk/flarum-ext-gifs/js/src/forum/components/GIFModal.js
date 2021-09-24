import app from 'flarum/app';
import Button from 'flarum/common/components/Button';
import HomeButton from './HomeButton';
import Modal from 'flarum/common/components/Modal';
import ResultButton from './ResultButton';
import Stream from 'flarum/common/utils/Stream';

const prefix = 'therealsujitk-gifs';

const ENGINE_GIPHY = 'giphy';
const ENGINE_TENOR = 'tenor';

const CATEGORY_HOME = 'home';
const CATEGORY_FAVOURITE = 'favourite';
const CATEGORY_TRENDING = 'trending';
const CATEGORY_RESULT = 'result';

export default class GIFModal extends Modal {
    oninit(vnode) {
        super.oninit(vnode);

        this.textArea = this.attrs.textArea;
        this.baseUrl = app.forum.attribute('baseUrl');
        this.engine = app.forum.attribute(`${prefix}.engine`) || 'giphy';
        this.apiKey = app.forum.attribute(`${prefix}.api_key`);
        this.rating = app.forum.attribute(`${prefix}.rating`) || 'off';

        this.Engine = this.getEngine();
        this.Engine.initialize(this.apiKey, this.rating);

        this.isHomeVisible = true;
        this.isFavouritesVisible = false;
        this.isTrendingVisible = false;
        this.isResultsVisible = false;

        this.category = '';
        this.query = Stream('');
        this.next = null;

        this.favourites = new Set();

        this.homeButtons = new Array();
        this.favouriteButtons = new Array();
        this.resultButtons = new Array();

        this.loadHomePage();
        this.loadFavouritesPage();

        this.loading = false;
        this.reachedEnd = false;
    }

    className() {
        return `${prefix}-modal`;
    }

    title() {
        return 'Select a GIF to add to your post';
    }

    /**
     * The body has four categories. HOME, FAVOURITES, TRENDING, RESULTS
     * TRENDING and RESULTS use the same container
     */
    content() {
        return (
            <div className="Modal-body">
                <div style="display: flex;">
                    <Button
                        id={`${prefix}-back-button`}
                        className="Button Button--icon hasIcon"
                        style={!this.isHomeVisible ? '' : 'display: none'}
                        icon="fas fa-long-arrow-alt-left"
                        onclick={this.showHome.bind(this)}
                    />
                    <span
                        id={`${prefix}-category`}
                        style={this.isFavouritesVisible || this.isTrendingVisible ? '' : 'display: none'}
                    >
                        {this.category && this.category}
                    </span>
                    <div
                        id={`${prefix}-search-input`}
                        className="Search-input"
                        style={this.isHomeVisible || this.isResultsVisible ? '' : 'display: none'}
                    >
                        <input
                            className="FormControl"
                            placeholder={this.getPlaceholder()}
                            value={this.query()}
                            bidi={this.query}
                            onkeydown={this.onkeydown.bind(this)}
                        />
                    </div>
                    <Button
                        id={`${prefix}-search-button`}
                        className="Button Button--primary"
                        style={this.isHomeVisible || this.isResultsVisible ? '' : 'display: none'}
                        onclick={() => {
                            this.resetResultsPage();
                            this.loadResultsPage();
                        }}
                    >
                        {app.translator.trans(`${prefix}.forum.search`)}
                    </Button>
                </div>

                <div className={`${prefix}-container`} style={this.isHomeVisible ? '' : 'display: none'}>
                    {this.homeButtons && this.homeButtons.map((homeButton) => <HomeButton attributes={homeButton} />)}
                </div>

                <div
                    className={`${prefix}-container`}
                    style={this.isFavouritesVisible ? '' : 'display: none'}
                    scrollTop={this.isTrendingVisible || this.isResultsVisible ? '0' : ''}
                >
                    {this.favouriteButtons &&
                        this.favouriteButtons.map((favouriteButton) => <ResultButton attributes={favouriteButton} />)}
                    <span id={`${prefix}-end`}>You've reached the end</span>
                </div>

                <div
                    className={`${prefix}-container`}
                    style={this.isTrendingVisible || this.isResultsVisible ? '' : 'display: none'}
                    onscroll={this.loadMore.bind(this)}
                    scrollTop={this.isTrendingVisible || this.isResultsVisible ? '0' : ''}
                >
                    {this.resultButtons &&
                        this.resultButtons.map((resultButton) => <ResultButton attributes={resultButton} />)}
                    <span id={`${prefix}-end`}>You've reached the end</span>
                </div>

                <div id={`${prefix}-footer`}>
                    <img
                        src={`${this.baseUrl}/assets/extensions/therealsujitk-gifs/powered_by_${this.engine}.svg`}
                    ></img>
                </div>
            </div>
        );
    }

    getEngine() {
        if (this.engine === ENGINE_TENOR) {
            return require('../helpers/Tenor');
        } else {
            return require('../helpers/Giphy');
        }
    }

    getPlaceholder() {
        if (this.engine == ENGINE_TENOR) {
            return app.translator.trans(`${prefix}.forum.searchTenor`);
        } else {
            return app.translator.trans(`${prefix}.forum.searchGiphy`);
        }
    }

    showHome() {
        this.isFavouritesVisible = false;
        this.isTrendingVisible = false;
        this.isResultsVisible = false;
        this.isHomeVisible = true;

        this.query('');
        this.resetResultsPage();
    }

    showFavourites() {
        this.isHomeVisible = false;
        this.isResultsVisible = false;
        this.isTrendingVisible = false;
        this.isFavouritesVisible = true;

        this.category = app.translator.trans(`${prefix}.forum.favourites`);
    }

    showTrending() {
        this.isHomeVisible = false;
        this.isFavouritesVisible = false;
        this.isResultsVisible = false;
        this.isTrendingVisible = true;

        this.category = app.translator.trans(`${prefix}.forum.trending`);
    }

    showResults() {
        this.isHomeVisible = false;
        this.isFavouritesVisible = false;
        this.isTrendingVisible = false;
        this.isResultsVisible = true;
    }

    async loadHomePage() {
        var favouritesButton = {
            title: app.translator.trans(`${prefix}.forum.favourites`),
            icon: 'fas fa-star',
            onclick: () => {
                this.showFavourites();
            }
        };

        var trendingButton = {
            title: app.translator.trans(`${prefix}.forum.trending`),
            icon: 'fas fa-chart-line',
            onclick: () => {
                this.loadTrendingPage();
            }
        };

        this.injectGIFs(null, 1, CATEGORY_HOME, 1); // Background for the trending button
        this.homeButtons.push(favouritesButton, trendingButton);

        var trendingTerms = await this.Engine.getTrendingTerms();

        for (var i = 0; i < trendingTerms.length; ++i) {
            var button = {
                title: trendingTerms[i],
                onclick: (e) => {
                    this.query(e.target.innerText);
                    this.loadResultsPage();
                }
            };

            this.injectGIFs(trendingTerms[i], this.homeButtons.length, CATEGORY_HOME, 1);
            this.homeButtons.push(button);
        }
    }

    async loadFavouritesPage() {
        app.store.find(prefix).then((response) => {
            var gifIDs = '';

            response.forEach((el) => {
                var gifID = el.data.attributes.gifID;
                gifIDs = `${gifIDs}${gifID},`;

                this.favouriteButtons.push({});
                this.favourites.add(gifID);
            });

            gifIDs = gifIDs.slice(0, -1);
            response.length && this.injectGIFs(gifIDs, 0, CATEGORY_FAVOURITE, response.length);
        });
    }

    async loadTrendingPage() {
        this.showTrending();

        for (var i = 0; i < this.Engine.getLimit(); ++i) {
            var button = {};
            this.resultButtons.push(button);
        }

        var startIndex = this.resultButtons.length - this.Engine.getLimit();
        this.injectGIFs(null, startIndex, CATEGORY_TRENDING, null);
        this.loading = false;
    }

    async loadResultsPage() {
        this.showResults();

        for (var i = 0; i < this.Engine.getLimit(); ++i) {
            var button = {};
            this.resultButtons.push(button);
        }

        var startIndex = this.resultButtons.length - this.Engine.getLimit();
        this.injectGIFs(this.query(), startIndex, CATEGORY_RESULT, null);
        this.loading = false;
    }

    resetResultsPage() {
        this.resultButtons = new Array();
        m.redraw.sync(); // WARNING: Make sure this method is not called during the mithril lifecycle

        this.next = null;
        this.reachedEnd = false;
    }

    loadMore(e) {
        if ((!this.isResultsVisible && !this.isTrendingVisible) || this.loading || this.reachedEnd) {
            return;
        }

        var scrollTop = e.target.scrollTop;
        var scrollDistance = e.target.scrollHeight - e.target.offsetHeight;

        if (scrollDistance != 0 && scrollTop >= scrollDistance - 200) {
            this.loading = true;

            if (this.isResultsVisible) {
                this.loadResultsPage();
            } else {
                this.loadTrendingPage();
            }
        }
    }

    /**
     * This function is sets the GIF id, title and url
     * after it has been added to the DOM window
     *
     * @param   {string|null}   t               query, gif ids or null
     * @param   {number}        startIndex      start index to set the properties
     * @param   {string}        category        the category of the button
     * @param   {number|null}   limit           the number of GIFs to be loaded
     */
    async injectGIFs(t, startIndex, category, limit) {
        var gifs;

        if (category === CATEGORY_FAVOURITE) {
            gifs = await this.Engine.getGIFsByIDs(t);
        } else if (category === CATEGORY_TRENDING || t == null) {
            var obj = await this.Engine.getTrendingGIFs(this.next, limit);

            gifs = obj.gifs;
            !limit && (this.next = obj.next);
        } else {
            obj = await this.Engine.getGIFs(t, this.next, limit);

            gifs = obj.gifs;
            !limit && (this.next = obj.next);
        }

        for (var i = 0; i < (limit || this.Engine.getLimit()); ++i) {
            if (gifs[i] === undefined) {
                if (category === CATEGORY_FAVOURITE) {
                    this.favouriteButtons.splice(startIndex + i);
                } else if (category === CATEGORY_RESULT) {
                    this.resultButtons.splice(startIndex + i);
                    this.reachedEnd = true;
                }

                break;
            }

            var gif = this.Engine.extractGIF(gifs[i]);
            var button = {};

            button.id = gif.id;
            button.title = gif.title;
            button.url = gif.url;
            button.isFavourite = this.favourites.has(gif.id);
            button.onclick = (e, id) => {
                var title = e.target.alt;
                var url = e.target.src;
                var embed = `![${this.engine[0].toUpperCase()}${this.engine.slice(1)} - ${title}](${url})`;

                this.textArea.insertAtCursor(embed);
                app.modal.close();

                // For the Tenor API, it is required to register the shared GIF
                if (this.engine === ENGINE_TENOR) {
                    var url = `https://g.tenor.com/v1/registershare?&key=${this.apiKey}${
                        this.query() != '' ? `&q=${this.query()}` : ''
                    }&id=${id}`;
                    fetch(url);
                }
            };
            button.favourite = async (id) => {
                var result = false;

                if (this.favourites.has(id)) {
                    await app
                        .request({
                            method: 'DELETE',
                            url: `${app.forum.attribute('apiUrl')}/${prefix}/${id}`
                        })
                        .then(() => {
                            var index = this.favouriteButtons.findIndex((el) => el.id === id);
                            this.favouriteButtons.splice(index, 1);
                            this.favourites.delete(id);

                            if (this.favouriteButtons.length == 0) {
                                delete this.homeButtons[0].url;
                            } else {
                                this.homeButtons[0].url = this.favouriteButtons[0].url;
                            }

                            result = true;
                        });
                } else {
                    await app.store
                        .createRecord(prefix)
                        .save({
                            gifID: id
                        })
                        .then(() => {
                            this.injectGIFs(id, 0, CATEGORY_FAVOURITE, 1);
                            this.favourites.add(id);

                            result = true;
                        });
                }

                return result;
            };

            if (category === CATEGORY_HOME) {
                this.homeButtons[startIndex + i].url = gif.url;
            } else if (category === CATEGORY_FAVOURITE) {
                if (this.favouriteButtons[startIndex + i] && this.favouriteButtons[startIndex + i].url === undefined) {
                    Object.assign(this.favouriteButtons[startIndex + i], button);
                } else {
                    // If a new favourite is added, not using a placeholder causes lesser problems
                    this.favouriteButtons.unshift(button);
                }

                // Changing the home button background
                if (startIndex + i == 0) {
                    this.homeButtons[0].url = gif.url;
                }
            } else {
                Object.assign(this.resultButtons[startIndex + i], button);
            }
        }

        m.redraw();
    }

    onsubmit(e) {
        e.preventDefault();
    }

    onkeydown(e) {
        if (e.key === 'Enter') {
            this.query(this.query().trim());

            if (this.query() === '') {
                this.showHome();
            } else {
                this.resetResultsPage();
                this.loadResultsPage();
            }
        }
    }
}
