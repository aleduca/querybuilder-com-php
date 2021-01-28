<?php

namespace Database\Query;

use Exception;
use Database\Query\interfaces\IBuilder;

class Select implements IBuilder
{
    private $fetchAll;

    public function __construct($fetchAll = true)
    {
        $this->fetchAll = $fetchAll;
    }

    public function execute($queries)
    {
        if (!$queries['select']) {
            throw new Exception('Por favor use o select');
        }

        return [
            'query' => "select {$queries['select']} from {$queries['table']}",
            'fetchAll' => $this->fetchAll
        ];
    }
}
