<?php 
/* This is part of the jordanjay/flarum-ext-summaries project.
 * 
 * Modified code (c)2019 Jordan Schnaidt
 *
 * Original code (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JordanJay29\Summaries\Listeners;

use Flarum\Api\Controller\ListDiscussionsController;
use Flarum\Api\Event\WillGetData;
use Illuminate\Contracts\Events\Dispatcher;

class AddApiAttributes
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(WillGetData::class, [$this, 'includeFirstPost']);
    }
    
    /**
     * @param WillGetData $event
     */
    public function includeFirstPost(WillGetData $event)
    {
        if ($event->isController(ListDiscussionsController::class)) {
            $event->addInclude('firstPost');
        }
    }
}
