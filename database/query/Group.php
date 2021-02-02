<?php

namespace Database\Query;

class Group
{
    public static function execute($queries)
    {
        if (!$queries['group']) {
            return;
        }

        return ' group by ' . $queries['group'];
    }
}
