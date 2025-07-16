<?php

namespace Drupal\custom_service;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Overrides the GreetingService
 */
class CustomServiceServiceProvider extends ServiceProviderBase {
    
    /**
     * To alter the 
     * @param \Drupal\Core\DependencyInjection\ContainerBuilder $container
     * 
     * @return void
     */
    public function alter(ContainerBuilder $container){
        $container->getDefinition('custom_service.greeting_service')
        ->setClass('Drupal\custom_service\Service\OverrideService')
        ->setArguments([new Reference('current_user')]);
    }
}
