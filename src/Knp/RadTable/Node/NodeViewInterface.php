<?php

namespace Knp\RadTable\Node;

interface NodeViewInterface
{
    function getParent();
    function getData();
    function setData($data);
    function getVars();
    function compile();
    function isCompiled();
}
