<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author chadt
 */

require_once "../includes/database.php";

$db = new MySQLDatabase();

class User {

    public static function find_all() {
        global $db;  
        $result_set = $db->query('select * from users');
        return $result_set;
    }
    
    public static function find_by_id($id=0) {
        global $db;
        $result_set = $db->query("select * from users where id={$id}");
        $found = $db->fetch_array($result_set);
        return $found;                      
    }
    
    public static function find_by_sql($sql="") {
        global $db;
        $result_set = $db->query($sql);
        return $result_set;
    }

}
