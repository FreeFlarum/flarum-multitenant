import app from 'flarum/app';
import File from './File';

import gpxMap from './gpxMap';

console.debug("GPX Preview Scanning...");

app.initializers.add('gpx-preview', () => {
    gpxMap();

    // File model
    app.store.models.files = File;
});
