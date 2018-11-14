<?php

namespace App\Graph\Resolver;


use App\Repository\PreferenceRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PreferenceResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var PreferenceRepository
     */
    private $preferenceRepository;

    /**
     *
     * @param PreferenceRepository $preferenceRepository
     */
    public function __construct(PreferenceRepository $preferenceRepository)
    {
        $this->preferenceRepository = $preferenceRepository;
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function resolve(int $id)
    {
        return $this->preferenceRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Preference',
        ];
    }

}