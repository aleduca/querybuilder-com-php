<?php

namespace Database\Query;

class Like
{
    public static function execute($queries)
    {
        if (!$queries['like']) {
            return;
        }

        $query = '';

        if (!$queries['where']) {
            $query .= ' where ';
        } else {
            $query .= ' and ';
        }

        foreach ($queries['like'] as $like) {
            $query .= $like . ' or ';
        }

        $query = preg_replace('/ or $/', '', $query);

        return $query;
    }
}
