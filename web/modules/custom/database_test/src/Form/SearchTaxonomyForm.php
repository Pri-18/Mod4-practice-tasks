<?php

namespace Drupal\database_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
 * Form to search taxonomy.
 */
class SearchTaxonomyForm extends FormBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $conn;

  /**
   * To add the drupal messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $msg;

  public function __construct() {
    $this->conn = Database::getConnection();
    // $this->msg = $msg;
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'taxonomy_search_form';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['search'] = [
      '#title' => $this->t('Search term'),
      '#type' => 'textfield',
      '#required' => TRUE,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $term = $form_state->getValue('search');
    $termId = $this->findTermId($term);
    $termId ? $termNodes = $this->findTermNodes($termId) : $termNodes = FALSE;
    $termId ? $termUUID = $this->findUUID($termId) : FALSE;

    if ($termId && $termUUID && $termNodes) {

      $message = "<strong>Term ID:</strong> {$termId}<br>";
      $message .= "<strong>UUID:</strong> {$termUUID}<br>";
      $message .= "<strong>Associated Nodes:</strong><br><ul>";

      foreach ($termNodes as $node) {
        $message .= "<li><a href='{$node['url']}' target=_blank>{$node['title']}</a></li>";
      }

      $message .= "</ul>";

      $this->messenger()->addMessage($message);
    }
    else {
      $this->messenger()->addWarning('No matching term or nodes found.');
    }
  }

  /**
   * To find the taxonomy term.
   *
   * @return array|bool
   *   the details about the term.
   */
  public function findTermId(string $term) {

    $query = $this->conn->select('taxonomy_term_field_data', 'td');

    $query->fields('td', ['tid']);

    $query->condition('td.name', $term, '= BINARY');

    $result = $query->execute()->fetchAssoc();
    return $result['tid'] ?: FALSE;
  }

  /**
   * To find the taxonomy term realed nodes.
   *
   * @return array|bool
   *   the nodes associated to the term.
   */
  public function findTermNodes(int $termId) {

    $query = $this->conn->select('node__field_type', 'nt');
    $query->join('node_field_data', 'n', "nt.entity_id = n.nid AND nt.field_type_target_id = $termId");

    $query->fields('n', ['nid', 'title']);
    $result = $query->execute()->fetchAll();

    foreach ($result as &$row) {
      $nodes[] = [
        'title' => $row->title,
        'url' => '/node/' . $row->nid,
      ];
    }
    return $nodes ?: FALSE;
  }

  /**
   * Finds the UUID for a given taxonomy term ID.
   *
   * @param int $term
   *   The taxonomy term ID.
   *
   * @return array|bool
   *   The UUID of the term or FALSE if not found.
   */
  public function findUuid(int $term) {
    $query = $this->conn->select('taxonomy_term_data', 'td');
    $query->fields('td', ['uuid']);
    $query->condition('td.tid', $term);
    $res = $query->execute()->fetchAssoc();
    return $res['uuid'] ?: 0;
  }

}
