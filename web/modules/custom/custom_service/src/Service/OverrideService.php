<?php

namespace Drupal\custom_service\Service;
use Drupal\Core\Session\AccountInterface;
use Drupal\custom_service\Service\GreetingService;

/**
 * Service to override the greetning service.
 */
class OverrideService extends GreetingService {

     /**
      * Returns new greetning message to logged-in user.
      * 
      * @return string
      */

    public function greeting() {
        $name = $this->currUser->getDisplayName();
        return "Hello, {$name}, from new service";
    }
}
