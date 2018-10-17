<?php
namespace App\Graph\Mutation;

use App\Entity\Place;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class PlaceMutation extends AbstractMutation implements MutationInterface, AliasedInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getAliases()
    {
        return [
            'signup' => 'signup',
            'placeEdit' => 'placeEdit',
        ];
    }


    public function placeEdit(array $data, string $placeId): Place
    {
        $place = $this->findEntity($placeId, Place::class);

        $place->setName($data['name']);
        $place->setAdress($data['address']);
        $place->setHandicapMoteur($data['handicap_moteur']);

        $this->validate($place);

        $this->em->persist($place);
        $this->em->flush();

        $this->em->refresh($place);

        return $place;
    }
}
