<?php

/*
 * This file is part of miniflar/bbcode-progress-bars-test.
 *
 * Copyright (c) 0E800.
 * Copyright (c) Christian Lopez.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace miniFLAR\BBCodeProgressBars;

use Flarum\Extend;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/resources/less/forum.less'),
    (new Extend\Formatter())
        ->configure(function (Configurator $config) {
            $config->BBCodes->addCustom(
                '[PBAR]{TEXT},{TEXT2},{COLOR},{COLOR2},{COLOR3},{NUMBER},{NUMBER2},{NUMBER3},{NUMBER4}[/PBAR]',
                '<div class="MiniFLAR-ProgressBar-container">
                            <h1 class="MiniFLAR-ProgressBar-header">{TEXT}</h1>
                                <div class="MiniFLAR-ProgressBar-meter" style="border: {NUMBER}px solid {COLOR};border-radius:{NUMBER3}px;
                                margin-bottom:{NUMBER4}px">
                                    <div class="MiniFLAR-ProgressBar-meter-status" style="width: {NUMBER2}%; background-color: {COLOR2};
                                        border-bottom-left-radius: {NUMBER3}px; border-top-left-radius: {NUMBER3}px;
                                        border-right: 0.5em solid {COLOR3}">
                                            <span class="MiniFLAR-ProgressBar-meter-pointer">{TEXT2}</span>
                                    </div>
                                </div>
                            </div>'
            );
        })
];
