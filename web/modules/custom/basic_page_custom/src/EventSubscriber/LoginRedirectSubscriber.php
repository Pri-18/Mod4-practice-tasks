<?php

namespace Drupal\basic_page_custom\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;

/**
 * Redirects the user to a custom welcome page after login.
 */
class LoginRedirectSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::RESPONSE => 'onRespond',
    ];
  }

  /**
   * Handles the response event to perform login-based redirection.
   *
   * @param \Symfony\Component\HttpKernel\Event\ResponseEvent $event
   */
  public function onRespond(ResponseEvent $event) {
    $request = $event->getRequest();
    $session = $request->getSession();

    if ($session->get('custom_login_redirect')) {
      $session->remove('custom_login_redirect');

      // Generate URL from route name.
      $url = Url::fromRoute('basic_page_custom.welcomePage')->toString();

      // Set the redirect response.
      $event->setResponse(new RedirectResponse($url));
    }
  }

}
