<?php

namespace Database\Query;

class Execute
{
    private $queries;

    public function setQuery($queries)
    {
        $this->queries = $queries;
    }

    public function execute($builder)
    {
        $connection = Connection::open();
        $response = $builder->execute($this->queries);

        $sql = SqlRaw::raw($response['query'], $this->queries);

        // echo json_encode($sql);
        // die();

        $prepare = $connection->prepare($sql);
        $prepare->execute();

        if ($builder instanceof Select) {
            $fetch = $response['fetchAll'] ? $prepare->fetchAll() : $prepare->fetch();
            echo json_encode($fetch);

            return ['rows' => $fetch];
        }

        // echo json_encode($response);
    }
}
