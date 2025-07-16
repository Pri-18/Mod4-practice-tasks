<?php
namespace Drupal\basic_page_custom\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\basic_page_custom\Service\LoadData;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for basic_page_custom module
 */
class BasicPageCustomController extends ControllerBase {

    protected $helloService;

    /**
     * Constructor for the service.
     */
    public function __construct(LoadData $helloService) {
        $this->helloService = $helloService;
    }

    /**
     * Dependency injection (create method)
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * 
     * @return static
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('basic_page_custom.hello_service')
        );
    }

    /**
     * Custom basic page.
     * 
     * @return array{#markup: string, #title: string}
     */
    public function basicPage(){
        return [
            '#title' => 'Custom basic page',
            '#markup' => 'Demo custom basic page'
        ];
    }

    /**
     * Custom info page.
     * 
     * @return array{#data: array{Email: string, Name: string, #theme: string, #title: mixed}}
     */
    public function infoPage(){
        $data = array(
            'Name' => 'Priyansu',
            'Email' => '@gmail.com'
        );

        return [
            '#title' => $this->helloService->hello(),
            '#theme' => 'information_page',
            '#data' => $data
        ];
    }

    /**
     * Custom welcome page
     * 
     * @return array{#markup: string}
     */
    public function welcomePage() {
        return [
            '#markup' => 'custom_welcome_page'
            // '#theme' => 'custom_welcome_page'
        ];
    }
    
}
