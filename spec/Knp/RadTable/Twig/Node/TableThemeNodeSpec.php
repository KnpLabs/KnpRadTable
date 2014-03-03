<?php

namespace spec\Knp\RadTable\Twig\Node;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableThemeNodeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('name', 'name', 0);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Twig\Node\TableThemeNode');
    }
}
