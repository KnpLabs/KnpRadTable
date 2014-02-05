<?php

namespace spec\Knp\RadTable\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Factory\TableFactory');
    }

    function it_should_build_a_table_view()
    {
        $this->create([], [], [])->shouldHaveType('Knp\RadTable\Node\TableView');
    }
}
