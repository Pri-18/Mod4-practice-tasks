<?php

namespace Drupal\alter_route\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class RouteAlter extends RouteSubscriberBase {

    /**
     * {@inheritDoc}
     */
    protected function alterRoutes(RouteCollection $collection) {
        $user_login_route = $collection->get('user.login');
        $user_login_route->setPath('/hello/login');

        $user_route = $collection->get('user.page');
        $user_route->setPath('/hello');

    }
}
