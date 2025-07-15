<?php
    namespace Drupal\alter_route\Controller;
    use Drupal\Core\Controller\ControllerBase;
    use Drupal\Core\Session\AccountInterface;
    use Drupal\Core\Access\AccessResult;

    /**
     * {@inheritDoc}
     */
    class RestrictedController extends ControllerBase {

        /**
         * Function to return the page
         * 
         * @return array{#markup: \Drupal\Core\StringTranslation\TranslatableMarkup}
         */
        public function restrictedPage() {
            return [
                '#markup' => $this->t('Restricted page')
            ];
        }

        public function access(AccountInterface $account){
            return in_array('content_editor', $account->getRoles()) || in_array('administrator', $account->getRoles())

                ? AccessResult::allowed()
                : AccessResult::forbidden();
        }
    }
