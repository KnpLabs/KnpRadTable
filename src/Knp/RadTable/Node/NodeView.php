<?php

namespace Knp\RadTable\Node;

class NodeView implements NodeViewInterface
{
    protected $parent;
    protected $vars;

    public function __construct($id, array $config = array())
    {
        $this->vars = array_merge(
            $this->getDefaultConfig(),
            array('id' => $id),
            $config
        );
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(NodeViewInterface $parent)
    {
        $this->parent = $parent;
        $this->vars['data'] = $this->parent->getData();
    }

    public function getData()
    {
        return $this->vars['data'];
    }

    public function compute()
    {
        $this->vars['blocks'] = $this->getRenderedBlockNames();

        if (null !== $this->parent) {
            $this->vars = array_merge($this->parent->getVars(), $this->vars);
        }
    }

    public function getVars()
    {
        return $this->vars;
    }

    protected function getRenderedBlockNames()
    {
        $names = array();

        foreach ($this->getBlockSuffixes() as $suffixe) {
            if (null !== $this->parent) {
                foreach ($this->parent->getRenderedBlockNames() as $name) {
                    $names[] = sprintf('%s_%s', $name, $suffixe);
                }
            } else {
                $names[] = sprintf('_%s', $suffixe);
            }
        }

        return $names;
    }

    protected function getBlockSuffixes()
    {
        return array(
            str_replace('.', '_', strtolower($this->vars['id'])),
            $this->vars['tag'],
        );
    }

    protected function getDefaultConfig()
    {
        return array(
            'tag' => 'td',
        );
    }
}
