<?php

namespace App\Graph\Type;

use GraphQL\Language\AST\Node;
use GraphQL\Type\Definition\ScalarType;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;

class DatetimeType extends ScalarType implements AliasedInterface
{
    /**
     * @param \DateTime $value
     *
     * @return string
     */
    public function serialize($value)
    {
        return $value->format('c');
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function parseValue($value)
    {
        return new \DateTime($value);
    }

    /**
     * @param Node $valueNode
     *
     * @return string
     */
    public function parseLiteral($valueNode, array $variables = null)
    {
        return $this->parseValue($valueNode->value);
    }

    public static function getAliases()
    {
        return ['Datetime'];
    }
}
