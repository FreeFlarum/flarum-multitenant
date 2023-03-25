<?php
namespace Maicol07\SSO\User;

use Maicol07\SSO\Flarum;

/**
 * Class Relationships
 * @package Maicol07\SSO\User
 */
class Relationships
{
    /** @var array */
    public $groups = [];
    
    public function toArray(Flarum $flarum): array
    {
        $groups = [];
        $flarum_groups = $flarum->api->groups()->request();
        foreach ($flarum_groups as $group) {
            if (in_array($group->attributes['nameSingular'], $this->groups, true)) {
                $groups[] = [
                    'type' => 'groups',
                    'id' => $group->id
                ];
            }
        }
        return [
            'groups' => [
                'data' => $groups
            ]
        ];
    }
}
