<?php

namespace Database\Query;

class Limit
{
    public static function execute($queries)
    {
        if (!$queries['limit']) {
            return;
        }

        return ' limit ' . $queries['limit'];
    }
}
