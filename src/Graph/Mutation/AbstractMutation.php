<?php
namespace App\Graph\Mutation;

use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Error\UserErrors;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractMutation
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $em) {
        $this->validator = $validator;
        $this->em = $em;
    }

    protected function validate(object $entity)
    {
        $errors = $this->validator->validate($entity);
        $messages = [];

        foreach ($errors as $field => $error) {
            $messages[] = sprintf('%s : %s', $error->getPropertyPath(), $error->getMessage());
        }

        if (count($errors) > 0) {
            throw new UserErrors($messages);
        }
    }

    protected function findEntity(string $uuid, string $className)
    {
        $entity = $this->em->find($className, $uuid);

        if (is_null($entity)) {
            throw new UserError('Object not found');
        }

        return $entity;
    }
}
