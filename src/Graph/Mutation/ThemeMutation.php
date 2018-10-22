<?php

namespace App\Graph\Mutation;

use App\Entity\Place;
use App\Entity\Theme;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class ThemeMutation extends AbstractMutation implements MutationInterface , AliasedInterface
{

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'placeTheme' => 'placeTheme' ,
        ];
    }

    /**
     * @param array $input
     * @return Theme
     */
    public function placeTheme(array $input)
    {
        $theme = new Theme();

        $theme->setName($input['name']);
        $theme->setValue($input['value']);

        $this->validate($theme);

        $this->em->persist($theme);
        $this->em->flush();

        return $theme;
    }

}
