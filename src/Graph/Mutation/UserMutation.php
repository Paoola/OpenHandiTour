<?php
namespace App\Graph\Mutation;

use App\Entity\User;
use App\Entity\UserPhoneNumber;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class UserMutation extends AbstractMutation implements MutationInterface, AliasedInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getAliases()
    {
        return [
            'signup' => 'signup',
            'userEdit' => 'userEdit',
        ];
    }

    public function signup(array $input): array
    {
        $user = (new User())
            ->setEmail($input['email'])
            ->setFirstName($input['firstName'])
            ->setLastName($input['lastName']);

        $this->validate($user);

        $this->em->persist($user);
        $this->em->flush();

        return [
            'user' => $user
        ];
    }

    public function userEdit(array $data, string $userId): User
    {
        $user = $this->findEntity($userId, User::class);

        $user->setEmail($data['email']);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);

        $this->validate($user);

        $this->em->persist($user);
        $this->em->flush();

        $this->em->refresh($user);

        return $user;
    }
}
