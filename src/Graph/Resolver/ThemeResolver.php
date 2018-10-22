<?php
namespace App\Graph\Resolver;


use App\Repository\ThemeRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ThemeResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var ThemeRepository
     */
    private $themeRepository;

    /**
     * ThemeResolver constructor.
     * @param ThemeRepository $themeRepository
     */
    public function __construct(ThemeRepository $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function resolve(int $id)
    {
        return $this->themeRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Theme',
        ];
    }
}