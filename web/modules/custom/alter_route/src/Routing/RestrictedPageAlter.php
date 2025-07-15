<?php

  namespace Drupal\alter_route\Routing;
  use Drupal\Core\Routing\RouteSubscriberBase;
  use Symfony\Component\Routing\RouteCollection;

  /**
   * {@inheritDoc}
   */
  class RestrictedPageAlter extends RouteSubscriberBase {
    protected function alterRoutes(RouteCollection $collection){
        $restrictedRoute = $collection->get('alter_route.restricted_page');

        //removing the editor role
        if($route = $restrictedRoute) {
            if ($route->hasRequirement('_role')) {
                $roles = explode('+', $route->getRequirement('_role'));
                $roles = array_diff($roles, ['content_editor']);
                $route->setRequirement('_role', implode('+', $roles));
            }
        }
    }
  }  
