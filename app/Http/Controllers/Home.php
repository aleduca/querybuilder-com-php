<?php

namespace App\Http\Controllers;

use Database\Query\QueryBuilder;
use Database\Query\Select;

class Home extends Controller
{
    private $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder;
    }

    public function index()
    {
        $this->queryBuilder->select()
        ->table('books')
        ->limit(10)
        ->like('title', 'Terror')
        ->like('description', 'Terror')
        ->execute(new Select);

        // echo json_encode($selected['ahaa']);

        /// select * from books where id > :id or id < :id
    }
}
