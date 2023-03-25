export function initialize(apiKey, rating) {
    this.baseUrl = 'https://g.tenor.com/v1';
    this.defaultLimit = 10;

    this.apiKey = apiKey;
    this.rating = rating;
}

export async function getTrendingTerms() {
    var terms;
    var url = `${this.baseUrl}/trending_terms?key=${this.apiKey}`;

    await fetch(url)
        .then((response) => response.json())
        .then((content) => {
            if (content.results === undefined) {
                console.error('Sorry, there was something wrong with the Tenor API Key.');
                return;
            }

            terms = content.results;
        });

    return terms;
}

export async function getTrendingGIFs(pos, limit) {
    var obj;
    var url = `${this.baseUrl}/trending?key=${this.apiKey}&contentfilter=${this.rating}&media_filter=minimal&limit=${
        limit || this.defaultLimit
    }${pos ? `&pos=${pos}` : ''}`;

    await fetch(url)
        .then((response) => response.json())
        .then((content) => {
            if (content.results === undefined) {
                console.error('Sorry, there was something wrong with the Tenor API Key.');
                return;
            }

            obj = {
                gifs: content.results,
                next: content.next
            };
        });

    return obj;
}

export async function getGIFs(query, pos, limit) {
    var obj;
    var url = `${this.baseUrl}/search?key=${this.apiKey}&q=${query}&contentfilter=${
        this.rating
    }&media_filter=minimal&limit=${limit || this.defaultLimit}${pos ? `&pos=${pos}` : ''}`;

    await fetch(url)
        .then((response) => response.json())
        .then((content) => {
            if (content.results === undefined) {
                console.error('Sorry, there was something wrong with the Tenor API Key.');
                return;
            }

            obj = {
                gifs: content.results,
                next: content.next
            };
        });

    return obj;
}

export async function getGIFsByIDs(ids) {
    var gifs;
    var url = `${this.baseUrl}/gifs?key=${this.apiKey}&ids=${ids}&media_filter=minimal`;

    await fetch(url)
        .then((response) => response.json())
        .then((content) => {
            gifs = content.results;
        });

    return gifs;
}

export function extractGIF(gif) {
    return {
        id: gif.id,
        title: gif.title,
        url: gif.media[0].gif.url
    };
}

export function getLimit() {
    return this.defaultLimit;
}
