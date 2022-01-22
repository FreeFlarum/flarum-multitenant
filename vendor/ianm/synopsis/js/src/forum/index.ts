import app from 'flarum/forum/app';

import addSummaryExcerpt from './addSummaryExcerpt';
import addUserPreference from './addUserPreference';

app.initializers.add('ianm-synopsis', () => {
  addSummaryExcerpt();
  addUserPreference();
});
