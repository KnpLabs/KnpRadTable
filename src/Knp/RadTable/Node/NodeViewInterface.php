<?php

namespace Knp\RadTable\Node;

interface NodeViewInterface
{
    function setParent(NodeViewInterface $node);
    function getParent();
    function setData($data);
    function getVars();
    function compile();
    function isCompiled();
}
