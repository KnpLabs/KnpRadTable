<?php

namespace Knp\RadTable\Node;

class RowView extends NodeView implements \IteratorAggregate
{
    protected $nodes;

    public function __construct($id, array $config = array())
    {
        parent::__construct($id, $config);

        $this->nodes = array();
    }

    public function add(NodeView $node)
    {
        $this->nodes[] = $node;
        $node->setParent($this);
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    public function compile()
    {
        parent::compile();

        foreach ($this->nodes as $node) {
            $node->compile();
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
        return array_merge(
            parent::getDefaultConfig(),
            array('tag' => 'tr')
        );
    }
}
