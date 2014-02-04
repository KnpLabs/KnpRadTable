<?php

namespace Knp\RadTable\Node;

class RowView extends NodeView implements \IteratorAggregate
{
    protected $nodes;

    public function __construct($id, $item = null, array $config = array())
    {
        parent::__construct(
            $id,
            array_merge(array('data' => $item), $config)
        );

        $this->nodes = array();
    }

    public function add(NodeView $node)
    {
        $node->setParent($this);
        $this->nodes[] = $node;
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    public function compute()
    {
        parent::compute();

        foreach ($this->nodes as $node) {
            $node->compute();
        }
    }

    public function getIterator() {
        return new \ArrayIterator($this->nodes);
    }

    protected function getBlockSuffixes()
    {
        return array( $this->vars['id'] );
    }


    protected function getDefaultConfig()
    {
        return array(
            'tag' => 'tr',
        );
    }
}
