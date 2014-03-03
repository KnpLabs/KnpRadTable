<?php

namespace spec\Knp\RadTable\Node;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableViewSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('name', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Node\TableView');
    }
}
