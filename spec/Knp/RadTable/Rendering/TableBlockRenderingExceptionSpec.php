<?php

namespace spec\Knp\RadTable\Rendering;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableBlockRenderingExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Rendering\TableBlockRenderingException');
    }
}
