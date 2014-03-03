<?php

namespace spec\Knp\RadTable\Twig;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableTokenParserSpec extends ObjectBehavior
{
    /**
     * @param Knp\RadTable\Twig\TableExtension $extension
     **/
    function let($extension)
    {
        $this->beConstructedWith($extension);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Twig\TableTokenParser');
    }
}
