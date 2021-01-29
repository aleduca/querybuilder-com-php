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
        $this->queryBuilder->select('books.id as bookId,title,description,pages,google_price,categories.name as categoryName')
        ->table('books')
        ->limit(100)
        ->execute(new Select);

        /// select * from books where id > :id or id < :id
    }
}
