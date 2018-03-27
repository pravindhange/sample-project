<?php
/**
 * Created by PhpStorm.
 * User: pravin
 * Date: 21/3/18
 * Time: 10:56 AM
 */

class connection
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'abcd1234';
    private $database = 'phpdb';

    protected $conn;

    public function __construct()
    {
        if (!isset($this->conn)) {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }
        }
        return $this->conn;
    }
}
