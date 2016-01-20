<?php

class DB_Connect {

    public $con = "";

    // constructor
    function __construct() {
        
    }

    // destructor
    function __destruct() {
        $this->close();
    }

    // Connecting to database
    public function connect() {
        require_once 'config.php';
        // connecting to mysql
        $this->con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        // selecting database
        mysql_set_charset('utf8', $this->con);
        mysql_select_db(DB_DATABASE, $this->con);
        // return database handler
        return $this->con;
    }

    // Closing database connection
    public function close() {
        mysql_close($this->con);
    }

}
