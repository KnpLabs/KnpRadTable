<?php

namespace spec\Knp\RadTable\Node;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RowViewSpec extends ObjectBehavior
{
    /**
     * @param Knp\RadTable\Node\NodeViewInterface $parent
     * @param Knp\RadTable\Node\NodeViewInterface $child1
     * @param Knp\RadTable\Node\NodeViewInterface $child2
     * @param Knp\RadTable\Node\NodeViewInterface $child3
     * @param StdClass $data
     **/
    function let($parent, $data, $child1, $child2, $child3)
    {
        $this->beConstructedWith('the_id', []);
        $this->setParent($parent);
        $this->add($child1);
        $this->add($child2);
        $this->add($child3);

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
        $this->shouldHaveType('Knp\RadTable\Node\RowView');
    }

    function it_should_change_node_data()
    {
        $data = new \StdClass;

        $this->setData($data);
        $this->getVars()->shouldReturn(array(
            'data' => $data,
            'id'   => 'the_id',
            'tag'  => 'tr',
        ));
    }

    function it_should_return_nodes($child1, $child2, $child3)
    {
        $this->getNodes()->shouldReturn(array($child1, $child2, $child3));
    }

    function it_should_return_an_array_of_vars($data)
    {
        $this->getVars()->shouldReturn(array(
            'data' => null,
            'id'   => 'the_id',
            'tag'  => 'tr',
        ));
    }

    function it_should_compile_node($parent, $child1, $child2, $child3)
    {
        $parent->getVars()->shouldBeCalled();
        $child1->compile()->shouldBeCalled();
        $child2->compile()->shouldBeCalled();
        $child3->compile()->shouldBeCalled();

        $this->compile();
        $this->getVars()->shouldReturn(array(
            'blocks' => array('_parent_the_id', '_array_the_id'),
            'data'   => null,
            'id'     => 'the_id',
            'tag'    => 'tr',
        ));
    }
}
