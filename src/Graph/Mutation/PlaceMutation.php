<?php
namespace App\Graph\Mutation;

use App\Entity\Place;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class PlaceMutation implements MutationInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewPlace',
        ];
    }

    public function resolve()
    {
        $place = new Place();
        $place->setName('name');
        $place->setAddress('address');
        $place->setHandicapMoteur('handicap_moteur');

        $this->em->persist($place);
        $this->em->flush();
        return ['content' => 'ok'];
    }
}
