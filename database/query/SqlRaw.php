<?php

namespace Database\Query;

class SqlRaw
{
    public static function raw($sql, $queries)
    {
        $sql .= Join::execute($queries);
        $sql .= Limit::execute($queries);

        return $sql;
    }
}
