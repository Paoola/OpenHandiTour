<?php
namespace App\Graph\Resolver;

use App\Repository\PlaceRepository;
use App\Entity\Place;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PlaceResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var PlaceRepository
     */
    private $placeRepository;

    /**
     *
     * @param PlaceRepository $placeRepository
     */
    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function resolve(int $id)
    {
        return $this->placeRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Place',
        ];
    }
}