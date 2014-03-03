<?php

namespace Knp\RadTable\Factory;

use Knp\RadTable\Node\TableView;
use Knp\RadTable\Node\RowView;
use Knp\RadTable\Node\NodeView;

class TableFactory implements TableFactoryInterface
{
    public function create($items, array $mapping, array $config = array())
    {
        $config = array_merge($this->getDefaultConfig(), $config);

        $table = new TableView($config['name'], $mapping);
        $table->setData($items);

        foreach ($mapping as $key => $label) {
            $node = new NodeView($key, array_merge($config, array('label' => $label, 'tag' => 'th')));
            $table->addHeader($node);
        }

        foreach ($items as $item) {
            $row = new RowView('item', $config);
            $row->setData($item);

            foreach ($mapping as $key => $label) {
                $node = new NodeView($key, array_merge($config, array('label' => $label)));
                $node->setData($item);
                $row->add($node);
            }

            $table->addRow($row);
            $row->setData($item);
        }

        return $table;
    }

    protected function getDefaultConfig()
    {
        return array(
            'name' => null
        );
    }
}
