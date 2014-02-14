<?php

namespace Knp\RadTable\Node;

class NodeView implements NodeViewInterface
{
    protected $parent;
    protected $vars;
    protected $compiled;

    public function __construct($id, array $config = array())
    {
        $this->vars = array_merge(
            $this->getDefaultConfig(),
            array('id' => $id),
            $config
        );
        $this->compiled = false;
    }

    public function isCompiled()
    {
        return $this->compiled;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(NodeViewInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    public function setData($data)
    {
        $this->vars['data'] = $data;

        return $this;
    }

    public function compile()
    {
        $this->compiled = true;

        $blocks = [];
        if (null !== $this->parent) {
            if (false === $this->parent->isCompiled()) {
                throw new \Exception('Parent node should be compiled');
            }

            $vars = $this->parent->getVars();
            $this->vars = array_merge($vars, $this->vars);

            foreach ($vars['blocks'] as $block) {
                foreach ($this->getBlockSuffixes() as $suffixe) {
                    $blocks[] = sprintf('%s_%s', $block, $suffixe);
                }
            }
        } else {
            $blocks = array_map(
                function ($e) { return sprintf('_%s', $e); },
                $this->getBlockSuffixes()
            );
        }
        $this->vars['blocks'] = $blocks;

        return $this;
    }

    public function getVars()
    {
        ksort($this->vars);

        return $this->vars;
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
            'tag'  => 'td',
            'data' => null,
        );
    }
}
