<?php

require_once 'config.php';

class MySQLDatabase {

    private $con;

    function __construct() {
        $this->open_connection();
    }

    public function open_connection() {
        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->con) {
            die("Database connection failed: " . mysqli_error());
        } else {
            $db_select = mysqli_select_db(DB_NAME, $this->con);
            if(!$db_select){
                die("Database connection failed: " . mysqli_error());
            }
        }
    }

    public function close_connection() {
        if (isset($this->con)) {
            mysqli_close($this->con);
            unset($this->con);
        }
    }

}

$db = new MySQLDatabase();

