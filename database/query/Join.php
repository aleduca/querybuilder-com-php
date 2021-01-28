<?php

namespace Database\Query;

class Join
{
    public static function execute($queries)
    {
        if (!$queries['join']) {
            return;
        }

        $query = '';
        foreach ($queries['join'] as $join) {
            $query .= $join;
        }

        return $query;
    }
}
