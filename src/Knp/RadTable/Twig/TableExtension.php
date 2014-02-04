<?php

namespace Knp\RadTable\Twig;

use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Knp\RadTable\Factory\TableFactory;
use Knp\RadTable\Rendering\TableRenderer;
use Knp\RadTable\Node\NodeViewInterface;

class TableExtension extends \Twig_Extension
{
    protected $themes;
    protected $tableFactory;
    protected $renderer;
    protected $twig;
    protected $accessor;

    public function __construct(TableFactory $tableFactory, TableRenderer $renderer, \Twig_Environment $twig, PropertyAccessor $accessor)
    {
        $this->themes       = array();
        $this->tableFactory = $tableFactory;
        $this->renderer     = $renderer;
        $this->twig         = $twig;
        $this->accessor     = $accessor;
    }

    public function getTokenParsers()
    {
        return array(
            new TableTokenParser($this),
        );
    }

    public function getFunctions()
    {
        return array(
            'knp_table'            => new \Twig_Function_Method($this, 'renderTable', array('is_safe'      => array('html'))),
            'knp_table_inner'      => new \Twig_Function_Method($this, 'renderNodeInner', array('is_safe'  => array('html'))),
            'knp_table_outter'     => new \Twig_Function_Method($this, 'renderNodeOutter', array('is_safe' => array('html'))),
            'knp_table_item_value' => new \Twig_Function_Method($this, 'renderItemValue'),
        );
    }

    public function setTheme($name, $template)
    {
        if (!array_key_exists($name, $this->themes)) {
            $this->themes[$name] = $this->twig->loadTemplate($template);
        }
    }


    public function renderTable($items, array $mapping, array $config = array())
    {
        $table = $this->tableFactory->create($items, $mapping, $config);
        $table->compute();

        return $this->renderNodeOutter($table);
    }

    public function renderNodeInner(NodeViewInterface $node)
    {
        return $this->renderer->renderNode($node, $this->themes, TableRenderer::SIDE_INNER);
    }

    public function renderNodeOutter(NodeViewInterface $node)
    {
        return $this->renderer->renderNode($node, $this->themes, TableRenderer::SIDE_OUTTER);
    }

    public function renderItemValue($item, $path)
    {
        return $this->accessor->getValue($item, $path);
    }

    public function getName()
    {
        return 'knp_table';
    }
}
