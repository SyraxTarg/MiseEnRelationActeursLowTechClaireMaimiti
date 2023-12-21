<?php

require_once 'config/database.php';

abstract class AbstractManager{
    protected string $table;
    protected PDO $db;

    public function __construct(){
        $this->db = $this->dbConnect();
    }

    public function dbConnect() {
        $db = new PDO(
            "pgsql:host=" . DB_CONFIG['host'] . ";port=" . DB_CONFIG['port'] . ";dbname=" . DB_CONFIG['dbname'] . ";user=" . DB_CONFIG['username'] . ";password=" . DB_CONFIG['password']
        );
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->exec("SET NAMES 'utf8'");
        return $db;
    }
}