<?php

namespace App;

class DB
{
    private static $instance = null;
    protected $dbh = null;

    const DRIVER = 'mysql';
    const HOST = 'localhost';
    const DBNAME = 'info_vape';
    const USER = 'root';
    const PWD = '';

    protected function __construct()
    {
       $this->dbh = new \PDO(self::DRIVER . ':host=' . self::HOST . ';dbname=' . self::DBNAME, self::USER, self::PWD);
    }

    protected function __clone()
    {
    }

    protected function __wakeup()
    {
    }

    static public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function execute(string $sql)
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute();
    }

    public function query(string $sql, array $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if (false === $res) {
            die('DB error in ' . $sql);
        }
        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

}