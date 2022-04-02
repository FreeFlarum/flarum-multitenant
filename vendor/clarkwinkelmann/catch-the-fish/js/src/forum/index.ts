import app from 'flarum/forum/app';
import addModels from './addModels';
import addFishBasket from './addFishBasket';
import addDropAreas from './addDropAreas';
import addPages from './addPages';
import addNavLinks from './addNavLinks';
import addRoundAlert from './addRoundAlert';
import calendar from 'dayjs/plugin/calendar';

// Import calendar plugin for Day.js
dayjs.extend(calendar)

app.initializers.add('clarkwinkelmann-catch-the-fish', () => {
    addModels();
    addFishBasket();
    addDropAreas();
    addPages();
    addNavLinks();
    addRoundAlert();
});
