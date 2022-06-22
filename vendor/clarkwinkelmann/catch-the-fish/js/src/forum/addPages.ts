import app from 'flarum/forum/app';
import Rankings from "./pages/Rankings";
import RoundList from './pages/RoundList';
import RoundSettings from './pages/RoundSettings';

export default function () {
    app.routes.catchTheFishRankings = {
        path: '/catch-the-fish',
        component: Rankings,
    };

    app.routes.catchTheFishRounds = {
        path: '/catch-the-fish/rounds',
        component: RoundList,
    };

    app.routes.catchTheFishRound = {
        path: '/catch-the-fish/rounds/:id',
        component: RoundSettings,
    };
}
