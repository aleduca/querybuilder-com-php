<?php

namespace Database\Query\interfaces;

interface IBuilder
{
    public function execute(array $queries);
}
