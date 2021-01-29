<?php

namespace Database\Query;

class Where
{
    public static function execute($queries)
    {
        if (!$queries['where']) {
            return;
        }

        $query = ' where ';

        foreach ($queries['where'] as $where) {
            $query .= $where . ' and ';
        }

        $query = preg_replace('/ and $/', '', $query);

        return $query;

        //select * from books where id > :id and title = :title and
    }
}
