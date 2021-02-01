<?php

namespace Database\Query;

class Offset
{
    public static function execute($queries)
    {
        if (!$queries['offset']) {
            return;
        }

        return ' offset ' . $queries['offset'];
    }
}
