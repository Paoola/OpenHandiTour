<?php

namespace App\Graph\Type;

use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;
use GraphQL\Type\Definition\ScalarType;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UuidType extends ScalarType implements AliasedInterface
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(ValidatorInterface $validator, array $config = [])
    {
        $this->validator = $validator;
        parent::__construct($config);
    }

    public function serialize($value): string
    {
        if (!$this->validate($value)) {
            throw new Error(sprintf('"%s" is not a valid identifier.', $value));
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->validate($value)) {
            throw new Error(sprintf('"%s" is not a valid identifier.', $value));
        }

        return $value;
    }

    public function parseLiteral($valueNode, array $variables = null): string
    {
        if (!$this->validate($valueNode->value)) {
            throw new Error(sprintf('"%s" is not a valid identifier.', $valueNode->value));
        }

        return $valueNode->value;
    }

    protected function validate(string $uuid): bool
    {
        if (empty($uuid)) {
            return false;
        }

        return count($this->validator->validate($uuid, new Uuid())) === 0;
    }

    public static function getAliases()
    {
        return ['Uuid'];
    }
}
