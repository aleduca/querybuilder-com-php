<?php

namespace Database\Query;

class Order
{
    public static function execute($queries)
    {
        if (!$queries['order']) {
            return;
        }

        return ' order by ' . $queries['order'];
    }
}
