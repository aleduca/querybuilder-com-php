<?php

namespace Database\Query;

use Exception;
use Database\Query\interfaces\IBuilder;

class Create implements IBuilder
{
    public function execute($queries)
    {
        if (!$queries['create']) {
            throw new Exception('Por favor use o método create');
        }

        return [
            'query' => "insert into {$queries['table']} (" . implode(',', array_keys($queries['create'])) . ') values (' . implode(',', array_values($queries['create'])) . ')'
        ];
    }
}
