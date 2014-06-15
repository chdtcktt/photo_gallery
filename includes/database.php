<?php

require_once "../includes/config.php";

class MySQLDatabase {

    private $con;
    public $last_query; //public variable to always get the last query if needed

    function __construct() {
        $this->open_connection();
    }

    //create db connection
    public function open_connection() {
        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->con) {
            die("Database connection failed: " . mysqli_error());
        } else {
            $db_select = mysqli_select_db($this->con, DB_NAME);
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
        $this->last_query = $sql;
        $result = mysqli_query($sql, $this->con);
        $this->confirm_query($result);
        return $result;
    }

    //prep values for submission to sql
    public function escape_value($value) {
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

    public function fetch_array($result_set) {
        return mysql_fetch_array($result_set);
    }

    public function num_rows($result_set) {
        return mysql_num_rows($result_set);
    }

    //get the last id insterted over the current db connection  
    public function insert_id() {
        return mysql_insert_id($this->con);
    }

    public function affected_rows() {
        return mysql_affected_rows($this->con);
    }

    //confirm the query from the db
    private function confirm_query($result_set) {
        if (!$result_set) {
            die("Database connection failed: " . mysqli_error() . "<br/>"
                    . "Last query: " . $this->last_query);
        }
    }

}


