<?php

namespace Database\Query;

use Exception;
use Database\Query\interfaces\IBuilder;

class QueryBuilder
{
    protected $queries = [
        'select' => '',
        'table' => '',
        'limit' => '',
        'join' => [],
        'where' => [],
        'binds' => [],
        'orWhere' => [],
        'offset' => 0,
        'like' => [],
        'order' => '',
        'group' => '',
        'create' => [],
        'update' => [],
        'paginate' => false
    ];

    public function select($fields = '*')
    {
        $this->queries['select'] = $fields;
        return $this;
    }

    public function table($table)
    {
        $this->queries['table'] = $table;
        return $this;
    }

    public function limit($limit)
    {
        $this->queries['limit'] = $limit;
        return $this;
    }

    public function join($table, $foreignKey)
    {
        // $this->queries['join'][] = " inner join {$table} on {$table}.id = {$this->queries['table']}.{$foreignKey}";
        array_push($this->queries['join'], " inner join {$table} on {$table}.id = {$this->queries['table']}.{$foreignKey}");
        return $this;
    }

    public function where(...$args)
    {
        $numArgs = count($args);

        if ($numArgs <= 1 || $numArgs > 3) {
            throw new Exception('O número de args tem quer no mínimo 2 e máximo 3');
        }

        $operator = '=';

        ($numArgs == 2) ?
        list($field, $value) = $args :
        list($field, $operator, $value) = $args;

        array_push($this->queries['binds'], $value);

        $this->queries['where'][] = "{$field} {$operator} ?";

        return $this;
    }

    public function orWhere(...$args)
    {
        $numArgs = count($args);

        if ($numArgs <= 1 || $numArgs > 3) {
            throw new Exception('O número de args tem quer no mínimo 2 e máximo 3');
        }

        $operator = '=';

        ($numArgs == 2) ?
        list($field, $value) = $args :
        list($field, $operator, $value) = $args;

        $this->queries['binds'][] = $value;

        $this->queries['orWhere'][] = "{$field} {$operator} ?";

        return $this;
    }

    public function like($field, $value)
    {
        $this->queries['like'][] = "{$field} like ?";
        $this->queries['binds'][] = "%{$value}%";
        return $this;
    }

    public function paginate($limit = 20)
    {
        (!$this->queries['limit']) ?
        $this->queries['limit'] = $limit :
        $limit = $this->queries['limit'];

        $this->queries['offset'] = (($_GET['page'] ?? 1) - 1) * $limit;
        $this->queries['select'] = 'SQL_CALC_FOUND_ROWS ' . $this->queries['select'];

        $this->queries['paginate'] = true;

        return $this;
    }

    public function order($field, $value)
    {
        $this->queries['order'] = "{$field} {$value}";
        return $this;
    }

    public function group($field)
    {
        $this->queries['group'] = $field;
        return $this;
    }

    public function create($field, $value = '')
    {
        // insert into users (name,last_name) values(?,?)
        if (is_array($field)) {
            foreach ($field as $key => $value) {
                $this->queries['create'][$key] = '?';
                $this->queries['binds'][] = $value;
            }
        } else {
            $this->queries['create'][$field] = '?';
            $this->queries['binds'][] = $value;
        }

        return $this;
    }

    public function update($field, $value = '')
    {
        if (is_array($field)) {
            foreach ($field as $key => $value) {
                $this->queries['update'][$key] = "{$key} = ?";
                $this->queries['binds'][] = $value;
            }
        } else {
            $this->queries['update'][$field] = "{$field} = ?";
            $this->queries['binds'][] = $value;
        }

        return $this;
    }

    public function execute(IBuilder $builder)
    {
        $execute = new Execute;
        $execute->setQuery($this->queries);
        return $execute->execute($builder);
    }
}
