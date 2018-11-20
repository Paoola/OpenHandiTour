<?php

namespace App\Graph\Mutation;


use App\Entity\Preference;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class PreferenceMutation extends AbstractMutation implements MutationInterface , AliasedInterface
{

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'newPreference' => 'newPreference' ,

        ];
    }


    public function newPreference(array $input)
    {
        $place = new Preference();
        $place->setName($input['name']);

        $this->em->persist($place);
        $this->em->flush();

        return $place;
    }
}