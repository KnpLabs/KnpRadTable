<?php

namespace Knp\RadTable\Node;

class TableView extends NodeView
{
    protected $headers;
    protected $rows;

    public function __construct($name, $items, $mapping)
    {
        parent::__construct(
            'table',
            array('mapping' => $mapping, 'data' => $items, 'name' => $name)
        );

        $this->headers = new RowView('header');
        $this->rows    = array();
        $this->footer  = new NodeView('footer', array('tag' => 'tfoot'));

        $this->headers->setParent($this);
        $this->footer->setParent($this);
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function addHeader(NodeView $header)
    {
        $this->headers->add($header);
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function addRow(RowView $row)
    {
        $row->setParent($this);
        $this->rows[] = $row;
    }

    public function getParent()
    {
        return null;
    }

    public function compute()
    {
        parent::compute();

        $this->headers->compute();

        foreach ($this->rows as $row) {
            $row->compute();
        }
    }

    protected function getBlockSuffixes()
    {
        $names = array();

        if (!empty($this->vars['name'])) {
            $names[] = $this->vars['name'];
        }

        $names[] = $this->vars['tag'];

        return $names;
    }

    protected function getDefaultConfig()
    {
        return array(
            'tag' => 'table',
        );
    }
}
