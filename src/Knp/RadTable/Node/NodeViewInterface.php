<?php

namespace Knp\RadTable\Node;

interface NodeViewInterface
{
    function getParent();
    function getData();
    function compute();
}
