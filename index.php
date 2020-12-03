<?php

class Connection
{
    private $odbc = "SQLServer";
    // private $server = "DESKTOP-KKF4E3F";
    private $user = "";
    private $pass = "";
    private $database = "MENARA.dbo";

    private $connect;
    private $statement;
    private $result;

    public function __construct()
    {
        // Create odbc instance
        try {
            // $this->connect = odbc_connect("Driver={SQL Server};Server=$this->server;Database=$this->database;  CharacterSet => UTF-8", $this->user, $this->pass);
            $this->connect = odbc_connect($this->odbc, $this->user, $this->pass);
        } catch (PDOException $e) {
            die(print_r(odbc_error(), true));
        }
    }

    // Read database property
    public function database()
    {
        return $this->database;
    }

    // Set the statement
    public function query($sql)
    {
        $this->statement = $sql;
        // print_r('<pre>');
        // var_dump($this->statement);
        // print_r('</pre>');
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $data = [];

        $this->result = odbc_exec($this->connect, $this->statement);

        while ($rows = odbc_fetch_object($this->result)) {
            array_push($data, $rows);
        }

        return $data;
    }

    // Get single record as object
    public function single()
    {
        $this->result = odbc_exec($this->connect, $this->statement);

        while ($rows = odbc_fetch_object($this->result)) {
            return $rows;
        }
    }

    // Get count of statement
    public function rowCount()
    {
        $this->result = odbc_exec($this->connect, $this->statement);

        return odbc_num_rows($this->result);
    }

    // Close Connection
    public function close()
    {
        odbc_close($this->connect);
    }
}