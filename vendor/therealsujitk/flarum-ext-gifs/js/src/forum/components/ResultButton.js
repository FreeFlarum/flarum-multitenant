import app from 'flarum/app';
import Component from 'flarum/common/Component';
import Button from 'flarum/common/components/Button';
import Tooltip from 'flarum/common/components/Tooltip';

const prefix = 'therealsujitk-gifs';

export default class ResultButton extends Component {
    oninit(vnode) {
        super.oninit(vnode);

        this.loading = false;
        this.hidden = true; // Hide the image until the height has been adjusted
        this.rowSpan = Math.random() * 15 + 25; // The number of rows the button covers (random before loading)

        this.id;

        $(window).resize(() => {
            if (!this.hidden) {
                this.setRowSpan(this.$('img', this)[0]);
            }
        });
    }

    view() {
        const attrs = this.attrs.attributes;

        this.id = attrs.id;
        this.favourite = attrs.favourite;

        const title = attrs.title;
        const url = attrs.url;
        const onclick = attrs.onclick;

        if (attrs.isFavourite) {
            if (!this.hidden) {
                this.setRowSpan(this.$('img', this)[0]);
            }
        }

        return (
            <div style={this.rowSpan && `grid-row-end: span ${Math.round(this.rowSpan)}`}>
                <img
                    alt={title}
                    src={url}
                    style={this.hidden ? 'visibility: hidden' : ''}
                    onclick={(e) => {
                        onclick(e, this.id);
                    }}
                    onload={(e) => {
                        this.setRowSpan(e.target);
                    }}
                />
                <Tooltip
                    showOnFocus={false}
                    text={
                        !attrs.isFavourite
                            ? app.translator.trans(`${prefix}.forum.addFavourite`)
                            : app.translator.trans(`${prefix}.forum.removeFavourite`)
                    }
                >
                    <Button
                        className={`Button Button--icon hasIcon`}
                        style={this.hidden ? 'visibility: hidden' : ''}
                        icon={!this.loading ? (attrs.isFavourite ? 'fas fa-star' : 'far fa-star') : ''}
                        loading={this.loading}
                        onclick={this.handleFavourite.bind(this)}
                    />
                </Tooltip>
            </div>
        );
    }

    setRowSpan(img) {
        this.rowSpan = img.height / 5 + 2;
        this.hidden = false;
    }

    async handleFavourite() {
        this.loading = true;
        var result = await this.favourite(this.id);

        if (result) {
            this.attrs.attributes.isFavourite = !this.attrs.attributes.isFavourite;
        }

        this.loading = false;
        m.redraw();
    }
}
