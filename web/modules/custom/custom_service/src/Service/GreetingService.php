<?php

namespace Drupal\custom_service\Service;

use Drupal\Core\Session\AccountProxyInterface;

/**
 * Service to generate greetning message.
 */
class GreetingService {

    protected $currUser;

    /**
     * Constructor use inject the current user.a
     * 
     * @param \Drupal\Core\Session\AccountProxyInterface $current_user
     */
    public function __construct(AccountProxyInterface $current_user) {
        $this->currUser = $current_user;
    }


    /**
     * Returns greetning message to logged-in user.
     * 
     * @return string
     */
    public function greeting() {
        $name = $this->currUser->getDisplayName();
        return "Hello, {$name}";
    }

}
