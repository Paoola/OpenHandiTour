<?php

namespace App\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;


class ExtraLoader extends Loader
{
    public function load($resource, $type = null)
    {
        $routes = new RouteCollection();

        $resource = '@ThirdPartyBundle/Resources/config/routes.yaml';
        $type = 'yaml';

        $importedRoutes = $this->import($resource, $type);

        $routes->addCollection($importedRoutes);

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'advanced_extra' === $type;
    }
}