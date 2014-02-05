<?php

namespace Knp\RadTable\Factory;

interface TableFactoryInterface
{
    function create($items, array $mapping, array $config = array());
}
