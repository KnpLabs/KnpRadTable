<?php

namespace Knp\RadTable\Twig;

use Twig_Node;
use Twig_Node_Block;
use Twig_Token;
use Twig_TokenParser;
use Twig_ExtensionInterface;
use Knp\RadTable\Twig\Node\TableThemeNode;

class TableTokenParser extends Twig_TokenParser
{
    protected $extension;

    public function __construct(TableExtension $extension)
    {
        $this->extension = $extension;
    }

    public function parse(Twig_Token $token)
    {
        $stream     = $this->parser->getStream();
        $exprParser = $this->parser->getExpressionParser();
        $env = $this->parser->getEnvironment();

        $expr = $this->parser->getExpressionParser()->parseExpression();
        $templateName = $expr->getAttribute('value');
        $tableName = '';
        if ($this->parser->getStream()->test(\Twig_Token::NAME_TYPE, 'for')) {
            $this->parser->getStream()->next();
            $expr = $this->parser->getExpressionParser()->parseExpression();
            $tableName = $expr->getAttribute('value');
        }
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new TableThemeNode($tableName, $templateName, $token->getLine());
    }

    public function getTag()
    {
        return 'table_theme';
    }
}
