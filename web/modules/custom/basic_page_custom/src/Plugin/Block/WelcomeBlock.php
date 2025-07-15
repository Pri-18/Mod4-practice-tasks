<?php

namespace Drupal\basic_page_custom\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'Welcome' Block.
 *
 * @Block(
 *   id = "welcome_block",
 *   admin_label = @Translation("Welcome Block"),
 * )
 */
class WelcomeBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $user = \Drupal::currentUser();
        $roles = $user->getRoles();
 
        // rmeove the authenticated role from the display
        $role_name = !empty($roles) ? ucfirst($roles[1]) : 'User';

        return [
            '#markup' => $this->t('Welcome @role', ['@role' => $role_name]),
        ];
    }

    // Blocking access for the anonymous users 
    public function blockAccess(AccountInterface $account) {
        return AccessResult::allowedIf($account->isAuthenticated());
    }
}
