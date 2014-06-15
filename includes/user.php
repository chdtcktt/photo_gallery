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

class User {

    private $db;

    function __construct() {
        $this->db = new MySQLDatabase();
    }

    public function find_all() {
        $result_set = $this->db->query('select * from users');
        return $result_set;
    }

}
