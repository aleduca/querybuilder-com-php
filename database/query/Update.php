<?php

namespace Database\Query;

use Exception;
use Database\Query\interfaces\IBuilder;

class Update implements IBuilder
{
    public function execute($queries)
    {
        if (!$queries['update']) {
            throw new Exception('Para fazer um update você precisa chamar o método update');
        }

        if ($queries['select']) {
            throw new Exception('Caso esteja querendo fazer um update remova o select');
        }

        if (!$queries['where']) {
            throw new Exception('Para fazer um update você precisa do método where');
        }

        return [
            'query' => "update {$queries['table']} set " . implode(',', $queries['update'])
        ];
    }
}
