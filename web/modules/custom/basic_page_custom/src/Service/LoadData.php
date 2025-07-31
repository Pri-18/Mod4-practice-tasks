<?php
namespace Drupal\basic_page_custom\Service;

use Drupal\Core\Database\Connection;

class LoadData {

    /**
     * The db connection
     * @var Connection
     */
    protected $database;        

    /**
     *To establish the conneciton
     * 
     * @param \Drupal\Core\Database\Connection $database
     */
    public function __construct(Connection $database) {
        $this->database = $database;
    }

    public function hello() {
        return 'Hello, Lets go to hell together';
    }

    /**
     * To set the data
     * 
     * @return void
     */
    public function setData() {

    }    
    
    /**
     * to get thhe data
     * 
     * @return void
     */
    public function getData() {
        
    }
}