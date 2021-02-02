<?php

namespace Database\Query;

use Exception;
use Database\Query\interfaces\IBuilder;

class Delete implements IBuilder
{
    public function execute($queries)
    {
        if ($queries['select']) {
            throw new Exception('Caso esteja querendo fazer um delete remova o select');
        }

        if (!$queries['where']) {
            throw new Exception('Para fazer um delete você precisa do método where');
        }

        return [
            'query' => "delete from {$queries['table']}"
        ];
    }
}
