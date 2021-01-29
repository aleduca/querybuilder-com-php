<?php

namespace Database\Query;

class OrWhere
{
    public static function execute($queries)
    {
        if (!$queries['orWhere']) {
            return;
        }

        $query = ' or ';

        foreach ($queries['orWhere'] as $where) {
            $query .= $where . ' or ';
        }

        $query = preg_replace('/ or $/', '', $query);

        return $query;

        //select * from books where id > :id or price < :price
        //
    }
}
