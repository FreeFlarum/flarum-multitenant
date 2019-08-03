/*
 * This file is part of DaRkFoxDeveloper/FlarumExtSpanish.
 * -----------------------------------------------------------------------
 * Copyright © 2015-2019 Toby Zerner and Flarum
 * Copyright © 2015-2019 DaRkFoxDeveloper
 * -----------------------------------------------------------------------
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import { Extend } from 'flarum/extend';
import app from 'flarum/app';

import SpanishSettingsModal from './components/SpanishSettingsModal';

app.initializers.add('darkfoxdeveloper-spanish', app => {
  app.extensionSettings['darkfoxdeveloper-spanish'] = () => app.modal.show(new SpanishSettingsModal());
});
