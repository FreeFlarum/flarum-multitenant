<?php

namespace Kilowhat\Audit\Search;

use Flarum\Search\AbstractSearcher;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Kilowhat\Audit\AuditLog;

class AuditSearcher extends AbstractSearcher
{
    protected function getQuery(User $actor): Builder
    {
        // Access control is managed at the controller level, not per record
        return AuditLog::query();
    }
}
