<?php
namespace App\Graph\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $em)
    {
        $this->validator = $validator;
        $this->em = $em;
    }

    /**
     * @param string $entity
     * @param string    $id
     *
     * @return object
     */
    public function find(string $entity, string $uuid)
    {
        if (count($this->validator->validate($uuid, new Uuid())) > 0) {
            throw new UserError('Invalid identifier');
        }

        $user = $this->em->find(sprintf('App:%s', $entity), $uuid);

        if (is_null($user)) {
            throw new UserError('User does not exists.');
        }

        return $user;
    }

    /**
     * @param string $entity
     * 
     * @return array
     */
    public function list(string $entity): array
    {
        return $this->em->getRepository(sprintf('App:%s', $entity))->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases()
    {
        return [
            'find' => 'entity',
            'list' => 'entities',
        ];
    }
}
