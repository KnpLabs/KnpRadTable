<?php

namespace Knp\RadTable\Twig\Node;

class TableThemeNode extends \Twig_Node
{
    protected $name;
    protected $template;

    public function __construct($name, $template, $lineno, $tag = null)
    {
        parent::__construct(array(), array(), $lineno, $tag);

        $this->name     = $name;
        $this->template = $template;
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('$this->env->getExtension(\'knp_table\')->setTheme(')
            ->write(sprintf('\'%s\'', $this->name))
            ->raw(', ')
            ->write(sprintf('\'%s\'', $this->template))
            ->raw(");\n");
        ;
    }
}
