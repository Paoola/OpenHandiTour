<?php

namespace App\Graph\Mutation;

use App\Entity\Place;
use App\Entity\Theme;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class PlaceMutation extends AbstractMutation implements MutationInterface , AliasedInterface
{

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'new' => 'placeNew' ,
            'placeEdit' => 'placeEdit' ,
            'placeLinkTheme' => 'placeLinkTheme' ,
            'getPlaceByTheme' => 'getPlaceByTheme',
        ];
    }

    public function new(array $input)
    {
        $place = new Place();
        $place->setName($input['name']);
        $place->setAddress($input['address']);
        $place->setHandicapMoteur($input['handicap_moteur']);

        $this->em->persist($place);
        $this->em->flush();

        return $place;
    }

    /**
     * @param array $data
     * @param string $placeId
     * @return null|object
     */
    public function placeEdit(array $data , string $placeId)
    {
        $place = $this->findEntity($placeId , Place::class);

        $place->setName($data['name']);
        $place->setAddress($data['address']);
        $place->setHandicapMoteur($data['handicap_moteur']);

        $this->validate($place);

        $this->em->persist($place);
        $this->em->flush();

        $this->em->refresh($place);

        return $place;
    }

    /**
     * @param string $placeId
     * @param string $themeId
     * @return null|object
     */
    public function placeLinkTheme(string $placeId , string $themeId)
    {
        $place = $this->findEntity($placeId , Place::class);
        $theme = $this->findEntity($themeId , Theme::class);

        $theme->addPlace($place);
        $place->setThemes($theme);

        $this->validate($place);

        $this->em->persist($place);
        $this->em->flush();

        $this->em->refresh($place);

        return $place;
    }

    /**
     * @param string $placeId
     * @return mixed
     */
    public function getPlaceByTheme(string $placeId)
    {
        $place = $this->findEntity($placeId , Place::class);

        return $place;
    }
}
