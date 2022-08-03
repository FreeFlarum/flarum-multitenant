<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace TheTurk\Stickiest;

use Flarum\Database\AbstractModel;
use Flarum\Discussion\Discussion;

/**
 * @property int        $discussion_id
 * @property int        $tag_id
 * @property Discussion $discussion
 * @property Tag        $tag
 */
class TagStickyState extends AbstractModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'discussion_sticky_tag';

    /**
     * {@inheritdoc}
     */
    protected $fillable = ['discussion_id', 'tag_id'];

    /**
     * Define the relationship with the discussion that this state is for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    /**
     * Define the relationship with the tag that this state is for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
