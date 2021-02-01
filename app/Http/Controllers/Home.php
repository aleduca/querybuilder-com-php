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
        $data = $this->queryBuilder->select('id,title, description')
        ->table('books')
        ->paginate()
        ->order('title', 'asc')
        ->execute(new Select);

        // echo json_encode($data);
        // die();

        return view('site.home', ['title' => 'Books', 'data' => $data]);

        // echo json_encode($selected['ahaa']);

        /// select * from books where id > :id or id < :id
    }
}
