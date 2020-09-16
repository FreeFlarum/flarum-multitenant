<?php

namespace TheTurk\WelcomeWidgets\Models;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class WelcomeWidgets extends AbstractModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'welcome_widgets';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_login_at', 'previous_login_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
