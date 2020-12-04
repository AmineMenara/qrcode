<?php

/**
 * Connection class
 * Connect to database
 * Create queries
 * Return rows and results
 */

class Connection
{
    private $odbc = "ODBC";
    private $user = "USER";
    private $pass = "PASSWORD";
    private $database = "DATABASE";

    private $connect;
    private $statement;
    private $result;

    public function __construct()
    {
        // Create odbc instance
        try {
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

    public function manipulation()
    {
        $this->result = odbc_exec($this->connect, $this->statement);

        if (!$this->result) {
            return 'error';
        } else {
            return 'success';
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
