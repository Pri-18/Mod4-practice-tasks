<?php

namespace Drupal\database_test\Service;

use Drupal\Core\Database\Connection;

/**
 * To test the DB of drupal.
 */
final class DbService {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $db;

  public function __construct(Connection $db) {
    $this->db = $db;
  }

  /**
   * To fetch the actice users of the site using tehe static query.
   *
   * @return array
   *   To fetch the users.
   */
  public function getActiveUsers() {
    $sql = $this->db->query("SELECT uid, name, created FROM {users_field_data} u WHERE uid <> 0 LIMIT 10 OFFSET 0");
    return $sql->fetchAll();

  }

}
