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
        $this->beConstructedWith('the_id', []);
        $this->setParent($parent);

        $parent->getVars()->willReturn([]);
        $parent->isCompiled()->willReturn(true);
        $parent->getVars()->willReturn(array(
            'id' => 'parent_id',
            'tag' => 'tr',
            'blocks' => array('_parent', '_array'),
        ));
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

    function it_should_change_node_data()
    {
        $data = new \StdClass;

        $this->setData($data);
        $this->getData()->shouldReturn($data);
        $this->getVars()->shouldReturn(array(
            'data' => $data,
            'id'   => 'the_id',
            'tag'  => 'td',
        ));
    }

    function it_should_return_an_array_of_vars($data)
    {
        $this->getVars()->shouldReturn(array(
            'data' => null,
            'id'   => 'the_id',
            'tag'  => 'td',
        ));
    }

    function it_should_compile_node($parent)
    {
        $parent->getVars()->shouldBeCalled();

        $this->compile();
        $this->getVars()->shouldReturn(array(
            'blocks' => array('_parent_the_id', '_parent_td', '_array_the_id', '_array_td'),
            'data'   => null,
            'id'     => 'the_id',
            'tag'    => 'td',
        ));
    }
}
