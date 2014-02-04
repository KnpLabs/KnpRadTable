<?php

namespace spec\Knp\RadTable\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableFactoryTestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Factory\TableFactoryTest');
    }
}
