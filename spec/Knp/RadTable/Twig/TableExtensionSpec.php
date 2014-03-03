<?php

namespace spec\Knp\RadTable\Twig;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Knp\RadTable\Factory\TableFactory;
use Knp\RadTable\Rendering\TableRenderer;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class TableExtensionSpec extends ObjectBehavior
{
    function let(TableFactory $factory, TableRenderer $renderer, \Twig_Environment $twig, PropertyAccessor $accessor)
    {
        $this->beConstructedWith($factory, $renderer, $twig, $accessor);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Twig\TableExtension');
    }
}
