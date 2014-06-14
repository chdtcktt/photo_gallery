<?php

require_once "../includes/config.php";

class MySQLDatabase {

    private $con;

    function __construct() {
        $this->open_connection();
    }

    //create db connection
    public function open_connection() {
        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->con) {
            die("Database connection failed: " . mysqli_error());
        } else {
            $db_select = mysqli_select_db($this->con,DB_NAME);
            if (!$db_select) {
                die("Database connection failed: " . mysqli_error());
            }
        }
    }

    //close db connection
    public function close_connection() {
        if (isset($this->con)) {
            mysqli_close($this->con);
            unset($this->con);
        }
    }

    //query db
    public function query($sql) {
        $result = mysqli_query($sql, $this->con);
        $this->confirm_query($result);
        return $result;
    }

    //prep values for submission to sql
    public function mysql_prep($value) {
        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_gpc = function_exists("mysql_real_escape_string"); // i.e, PHP >= v4.3.0

        if ($new_enough_gpc) {
            if ($magic_quotes_active) {
                $value = stripslashes($value);
            }
            $value = mysql_real_escape_string($value);
        } else {
            if (!$magic_quotes_active) {
                $value = addslashes($value);
            }
        }
        return $value;
    }

    //confirm the query from the db
    private function confirm_query($result_set) {
        if (!$result_set) {
            die("Database connection failed: " . mysqli_error());
        }
    }

}

$db = new MySQLDatabase();

