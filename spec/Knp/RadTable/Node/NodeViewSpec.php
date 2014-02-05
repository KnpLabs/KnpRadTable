<?php

namespace spec\Knp\RadTable\Node;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NodeViewSpec extends ObjectBehavior
{
    /**
     * @param Knp\RadTable\Node\NodeViewInterface $parent
     * @param Knp\RadTable\Node\NodeViewInterface $parent2
     * @param StdClass $data
     **/
    function let($parent, $parent2, $data)
    {
        $this->beConstructedWith('TheId', []);
        $this->setParent($parent);

        $parent->getData()->willReturn($data);
        $parent2->getData()->willReturn($data);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\RadTable\Node\NodeView');
    }

    function it_should_be_linked_to_parent($parent)
    {
        $this->getParent()->shouldReturn($parent);
    }

    function it_should_replace_the_parent($parent2)
    {
        $this->setParent($parent2)->shouldReturn($this);
        $this->getParent()->shouldReturn($parent2);
    }

    function it_should_return_parent_data($data)
    {
        $this->getData()->shouldReturn($data);
    }

    function it_should_change_node_data()
    {
        $data = new \StdClass;

        $this->setData($data);
        $this->getData()->shouldReturn($data);
    }

    function it_should_return_an_array_of_vars($data)
    {
        $this->getVars()->shouldBeArray();
    }
}
