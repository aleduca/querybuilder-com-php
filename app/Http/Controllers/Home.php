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
        $this->queryBuilder->select('comments.id as commentId,title,description,name,last_name,pages')
        ->table('comments')
        ->join('books', 'bookId')
        ->join('users', 'userId')
        ->execute(new Select);
    }
}
