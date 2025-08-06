<?php

namespace Drupal\database_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

/**
 * To construct the controller for event Contetn type.
 */
class EventController extends ControllerBase {
  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $conn;

  public function __construct() {
    $this->conn = Database::getConnection();
  }

  /**
   * To create the dashboard.
   *
   * @return array
   *   The dashboard.
   */
  public function dashboard() {
    $yearly_count = $this->getYealyCount();
    $quarter_count = $this->getQuarterlyEvents();
    $type_count = $this->getTypeEvents();
    return [
      '#title' => 'Event counts',
      '#theme' => 'dashboard',
      '#yearly_count' => $yearly_count,
      '#quarter_count' => $quarter_count,
      '#type_count' => $type_count,
    ];
  }

  /**
   * To get the yearly count of the events.
   *
   * @return array
   *   Fetches each row.
   */
  public function getYealyCount() {
    $query = $this->conn->select('node_field_data', 'n');
    $query->join('node__field_date', 'f_date', 'n.nid = f_date.entity_id');

    // Extract the YEAR part from the field_date_value.
    $query->addExpression('YEAR(f_date.field_date_value)', 'event_year');
    $query->addExpression('COUNT(n.nid)', 'event_count');

    $query->condition('n.type', 'event');
    $query->condition('n.status', 1);

    $query->groupBy('event_year');
    $query->orderBy('event_year', 'DESC');

    $result = $query->execute()->fetchAll();

    return $result;
  }

  /**
   * To get the Quarterly count of the events.
   *
   * @return array
   *   Fetches each row.
   */
  public function getQuarterlyEvents() {
    $query = $this->conn->select('node_field_data', 'n');
    $query->join('node__field_date', 'f_date', 'n.nid = f_date.entity_id');

    $query->addExpression('YEAR(f_date.field_date_value)', 'event_year');
    $query->addExpression('QUARTER(f_date.field_date_value)', 'event_quarter');
    $query->addExpression('COUNT(n.nid)', 'event_count');

    $query->condition('n.type', 'event');
    $query->condition('n.status', 1);

    $query->groupBy('event_quarter');
    $query->groupBy('event_year');
    $query->orderBy('event_year', 'DESC');

    $res = $query->execute()->fetchAll();
    return $res;

  }

  /**
   * To get the count of the events by types.
   *
   * @return array
   *   Fetches the the count of events.
   */
  public function getTypeEvents() {
    $query = $this->conn->select('node__field_type', 't');
    $query->Join('taxonomy_term_field_data', 'td', 't.field_type_target_id = td.tid');

    $query->fields('t', ['field_type_target_id']);
    $query->fields('td', ['name']);

    $query->addExpression("COUNT(field_type_target_id)", 'event_count');
    $query->addExpression("td.name", 'event_name');

    $query->condition('t.bundle', 'event');

    $query->groupBy('t.field_type_target_id');
    $query->groupBy('td.name');

    $query->orderBy('event_count');

    $res = $query->execute()->fetchAll();

    return $res;
  }

}
